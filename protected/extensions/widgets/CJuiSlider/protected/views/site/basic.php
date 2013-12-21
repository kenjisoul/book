&lt;h1>CJuiSlider Input : Basic&lt;/h1>
&lt;label for="amt">Volume:&lt;/label>
&lt;input type="text" id="amount_basic" style="border:0; color:#f6931f; font-weight:bold;" value="50" />
&lt;?php
$this->widget('zii.widgets.jui.CJuiSliderInput', array(
    'name'=>'slider_basic',
    'value'=>50,// default selection 
    'event'=>'change',
    'options'=>array(
        'min'=>0, //minimum value for slider input
        'max'=>100, // maximum value for slider input
        // on slider change event 
        'slide'=>'js:function(event,ui){$("#amount_basic").val(ui.value);}',
    ),
    // slider css options
    'htmlOptions'=>array(
        'style'=>'width:200px;'
    ),
));
?>