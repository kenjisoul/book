&lt;h1>CJuiSlider Input : Ranger&lt;/h1>
&lt;label for="amt">Volume:&lt;/label>
&lt;input type="text" id="amount-range" style="border:0; color:#f6931f; font-weight:bold;" value="1050-2750" />
&lt;?php
$this->widget('zii.widgets.jui.CJuiSliderInput', array(
    'name'=>'slider_range',
     
    'event'=>'change',
    'options'=>array(
        'values'=>array(1050,2750),// default selection
        'min'=>0, //minimum value for slider input
        'max'=>5000, // maximum value for slider input
        'animate'=>true,
        // on slider change event 
        'slide'=>'js:function(event,ui){$("#amount-range").val(ui.values[0]+\'-\'+ui.values[1]);}',
    ),
    // slider css options
    'htmlOptions'=>array(
        'style'=>''
    ),
));
?>