&lt;h1>CJuiSlider Input : Ajax Reques On Change&lt;/h1>
&lt;label for="amt">Volume:&lt;/label>
&lt;input type="text" id="amount-range-action" style="border:0; color:#f6931f; font-weight:bold;" value="1050-2750" />
&lt;?php
$ajaxurl=Yii::app()->createAbsoluteUrl("cjuislider/ajax");
$this->widget('zii.widgets.jui.CJuiSliderInput', array(
    'name'=>'slider_range_action',     
    'event'=>'change',
    'options'=>array(
        'values'=>array(1050,2750),// default selection
        'min'=>0, //minimum value for slider input
        'max'=>5000, // maximum value for slider input
        'animate'=>true,
        // on slider change event
        //$("#amount-range").val(ui.values[0]+\'-\'+ui.values[1]); 
        'slide'=>'js:function(event,ui){
            $.ajax({
                    url:"'.$ajaxurl.'",
                    data:"range1="+ui.values[0]+"&range2="+ui.values[1],
                    success:function(data){
                            $("#amount-range-action").val(data);
                        }                
                });            
            
            }',
    ),
    // slider css options
    'htmlOptions'=>array(
        'style'=>''
    ),
));
?>