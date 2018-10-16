<?php

namespace App\Imports;

use App\Models\{Links,Catalog};
use League\Csv\Reader;
use Carbon\Carbon;

class LinksImportFromCsv
{

    /**
     * @param $path
     * @return int
     * @throws \League\Csv\Exception
     */
   public static function import($path)
   {
       $n = 0;
       $csv = Reader::createFromPath($path, 'r');
       $csv->setDelimiter(';');

       foreach ($csv as $index => $row) {

           $city = isset($row[0]) ? trim(str_to_utf8($row[0])) : '';
           $name = isset($row[1]) ?  trim(str_to_utf8($row[1])) : '';
           $category = isset($row[3]) ? trim(str_to_utf8($row[3])) : '';
           $url = isset($row[5]) ? trim($row[5]) : '';
           $email = isset($row[6]) ? trim($row[6]) : '';
           $phone = isset($row[7]) ? trim($row[7]) : '';

           if ($url && isDomainAvailible($url, 5)) {

               $url_link =  $url;

               if (substr( $url_link, 0, 7) == "http://") $url_link = str_replace('http://', '', $url_link);
               if (substr( $url_link, 0, 8) == "https://") $url_link = str_replace('https://', '', $url_link);
               if (strpos( $url_link, '/') > 0) list($url_link) = explode('/', $url_link);

               if (Links::where('url', '=',  $url_link)->count() == 0) {
                   $tags_row = @get_meta_tags($url);

                   $tags = [];

                   if ($tags_row) {
                       foreach($tags_row as $mkey => $mval) {
                           $tags[$mkey] = str_to_utf8($mval);
                       }
                   }

                   $keywords = isset($tags['keywords']) ? trim($tags['keywords']) : '';
                   $full_description = isset($tags['description']) ? trim($tags['description']) : '';

                   preg_match_all("/(.+?)(\s+)([А-Я]{2,})(\.|\?|!){1,}(\s|<br(| \/)>|<\/p>|<\/div>)/ius",$full_description,$desc_out);

                   $description = isset($desc_out[0][0]) ? $desc_out[0][0] : '';

                   if ($description && $full_description != "\xF0\x9F\x91\x8D") {

                       $n++;

                       $arr = explode('/', $category);
                       $n_arr = [];

                       $parent_id = 0;

                       for ($i = 0; $i < count($arr); $i++) {
                           $parent_id = self::importCategory(trim($arr[$i]), $parent_id);
                           $n_arr[$i] = ['name' => $arr[$i], 'id' => $parent_id];
                       }

                       $category = array_pop($n_arr);

                        Links::create([
                               'name' => removeEmoji($name),
                               'url' => $url_link,
                               'email' => $email,
                               'phone' => $phone,
                               'city' => $city,
                               'description' => mb_ucfirst(removeEmoji(trim($description))),
                               'keywords' => $keywords,
                               'full_description' => mb_ucfirst(removeEmoji(trim($full_description))),
                               'catalog_id' => isset($category['id']) ? $category['id'] : 3,
                               'time_check' => Carbon::now(),
                               'status' => 1,
                               'token' => md5($url . time())]
                       );
                   }
               }
           }
       }

       return $n;
   }

    /**
     * @param $name
     * @param int $parent_id
     * @return mixed
     */
    private static function importCategory($name, $parent_id = 0)
    {
        if (!empty($name) && is_numeric($parent_id)) {
            $catalog = Catalog::where('name', 'like', $name)->where('parent_id', $parent_id);

            if ($catalog->count() > 0) {
                return $catalog->first()->id;
            } else {
                if ($name) {
                    Catalog::create(['name' => $name, 'parent_id' => $parent_id]);
                }
            }
        }
    }

}
