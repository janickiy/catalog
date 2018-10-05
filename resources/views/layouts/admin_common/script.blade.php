<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="{!! asset('js/plugin/pace/pace.min.js') !!}"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="{!! asset('js/libs/jquery-3.2.1.min.js') !!}"><\/script>');
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="{!! asset('js/libs/jquery-ui.min.js') !!}"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
{!! Html::script('js/app.config.js') !!}

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
{!! Html::script('js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') !!}

<!-- BOOTSTRAP JS -->
{!! Html::script('js/bootstrap/bootstrap.min.js') !!}

<!-- CUSTOM NOTIFICATION -->
{!! Html::script('js/notification/SmartNotification.min.js') !!}

<!-- JARVIS WIDGETS -->
{!! Html::script('js/smartwidgets/jarvis.widget.min.js') !!}

<!-- EASY PIE CHARTS -->
{!! Html::script('js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') !!}

<!-- SPARKLINES -->
{!! Html::script('js/plugin/sparkline/jquery.sparkline.min.js') !!}

<!-- JQUERY VALIDATE -->
{!! Html::script('js/plugin/jquery-validate/jquery.validate.min.js') !!}

<!-- JQUERY MASKED INPUT -->
{!! Html::script('js/plugin/masked-input/jquery.maskedinput.min.js') !!}

<!-- JQUERY SELECT2 INPUT -->
{!! Html::script('js/plugin/select2/select2.min.js') !!}

<!-- JQUERY UI + Bootstrap Slider -->
{!! Html::script('js/plugin/bootstrap-slider/bootstrap-slider.min.js') !!}

<!-- browser msie issue fix -->
{!! Html::script('js/plugin/msie-fix/jquery.mb.browser.min.js') !!}


<!-- FastClick: For mobile devices -->
{!! Html::script('js/plugin/fastclick/fastclick.min.js') !!}


<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- MAIN APP JS FILE -->
{!! Html::script('js/app.min.js') !!}

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
{!! Html::script('js/speech/voicecommand.min.js') !!}

<!-- SmartChat UI : plugin -->
{!! Html::script('js/smart-chat-ui/smart.chat.ui.min.js') !!}

{!! Html::script('js/smart-chat-ui/smart.chat.manager.min.js') !!}

{!! Html::script('js/plugin/datatables/jquery.dataTables.min.js') !!}

{!! Html::script('js/plugin/datatables/dataTables.colVis.min.js') !!}

{!! Html::script('js/plugin/datatables/dataTables.tableTools.min.js') !!}

{!! Html::script('js/plugin/datatables/dataTables.bootstrap.min.js') !!}

{!! Html::script('js/plugin/datatable-responsive/datatables.responsive.min.js') !!}

{!! Html::script('js/plugin/daterangepicker/moment.min.js') !!}

{!! Html::script('js/plugin/daterangepicker/daterangepicker.js') !!}

{!! Html::script('js/plugin/sweetalert/sweetalert-dev.js') !!}

{!! Html::script('js/plugin/jquery-treeview-master/jquery.treeview.js') !!}


<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->