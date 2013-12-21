<h1>CJuiSlider Input : Basic</h1>
<label for="amt">Volume:</label>
<input type="text" id="amount_basic" style="border:0; color:#f6931f; font-weight:bold;" value="50" />
<?php
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
<pre class="brush:php">
<?php include_once("basic.php"); ?>
</pre>
<hr />
<h1>CJuiSlider Input : Animate</h1>
<label for="amt">Volume:</label>
<input type="text" id="amount_animate" style="border:0; color:#f6931f; font-weight:bold;" value="50" />
<?php
$this->widget('zii.widgets.jui.CJuiSliderInput', array(
    'name'=>'slider_animate',
    'value'=>50,// default selection 
    'event'=>'change',
    'options'=>array(
        'min'=>0, //minimum value for slider input
        'max'=>100, // maximum value for slider input
        'animate'=>true,
        // on slider change event 
        'slide'=>'js:function(event,ui){$("#amount_animate").val(ui.value);}',
    ),
    // slider css options
    'htmlOptions'=>array(
        'style'=>'width:200px;background-color:red;'
    ),
));
?>
<pre class="brush:php">
<?php include_once("animate.php"); ?>
</pre>
<hr />
<h1>CJuiSlider Input : Fixed Maximum</h1>
<label for="amt">Volume:</label>
<input type="text" id="amount_fixed_maximum" style="border:0; color:#f6931f; font-weight:bold;" value="50" />
<?php
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
<pre class="brush:php">
<?php include_once("fix-maximum.php"); ?>
</pre>
<hr />
<h1>CJuiSlider Input : Vertical</h1>
<label for="amt">Volume:</label>
<input type="text" id="amount_vertical" style="border:0; color:#f6931f; font-weight:bold;" value="50" />
<?php
$this->widget('zii.widgets.jui.CJuiSliderInput', array(
    'name'=>'slider_vertical',
    'value'=>50,// default selection 
    'event'=>'change',
    'options'=>array(
        'min'=>0, //minimum value for slider input
        'max'=>100, // maximum value for slider input
        'animate'=>true,
        'orientation'=>'vertical',
        // on slider change event 
        'slide'=>'js:function(event,ui){$("#amount_vertical").val(ui.value);}',
    ),
    // slider css options
    'htmlOptions'=>array(
        'style'=>''
    ),
));
?>
<pre class="brush:php">
<?php include_once("vertical.php"); ?>
</pre>
<hr />
<h1>CJuiSlider Input : Vertical &amp; Step Value</h1>
<label for="amt">Volume:</label>
<input type="text" id="amount-vertical-step" style="border:0; color:#f6931f; font-weight:bold;" value="50" />
<?php
$this->widget('zii.widgets.jui.CJuiSliderInput', array(
    'name'=>'slider_vertical_step',
    'value'=>50,// default selection 
    'event'=>'change',
    'options'=>array(
        'step'=>10,
        'min'=>0, //minimum value for slider input
        'max'=>100, // maximum value for slider input
        'animate'=>true,
        'orientation'=>'vertical',
        // on slider change event 
        'slide'=>'js:function(event,ui){$("#amount-vertical-step").val(ui.value);}',
    ),
    // slider css options
    'htmlOptions'=>array(
        'style'=>''
    ),
));
?>
<pre class="brush:php">
<?php include_once("vertical-step.php"); ?>
</pre>
<hr />
<h1>CJuiSlider Input : Ranger</h1>
<label for="amt">Volume:</label>
<input type="text" id="amount-range" style="border:0; color:#f6931f; font-weight:bold;" value="1050-2750" />
<?php
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
<pre class="brush:php">
<?php include_once("ranger.php"); ?>
</pre>
<hr />
<h1>CJuiSlider Input : Ajax Reques On Change</h1>
<label for="amt">Volume:</label>
<input type="text" id="amount-range-action" style="border:0; color:#f6931f; font-weight:bold;" value="1050-2750" />
<?php
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
<pre class="brush:php">
<?php include_once("ajax-ranger.php"); ?>
</pre>
<hr />