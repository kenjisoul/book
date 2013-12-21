&lt;h1>CJuiSlider Input : Fixed Maximum&lt;/h1>
&lt;label for="amt">Volume:&lt;/label>
&lt;input type="text" id="amount_fixed_maximum" style="border:0; color:#f6931f; font-weight:bold;" value="50" />
&lt;?php
$this->widget('zii.widgets.jui.CJuiSliderInput', array(
    'name'=>'slider_fixed_maximum',
    'value'=>50,// default selection 
    'event'=>'change',
    'options'=>array(
        'min'=>0, //minimum value for slider input
        'max'=>100, // maximum value for slider input
        'animate'=>true,
        'range'=>'max',
        // on slider change event 
        'slide'=>'js:function(event,ui){$("#amount_fixed_maximum").val(ui.value);}',
    ),
    // slider css options
    'htmlOptions'=>array(
        'style'=>'width:200px;background-color:red;'
    ),
));
?>