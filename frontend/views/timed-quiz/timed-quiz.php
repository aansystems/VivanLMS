<?php

use yii\helpers\Html;
use kartik\dialog\Dialog;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */
/* @var $form yii\widgets\ActiveForm */

$request = Yii::$app->request;
$get = $request->get();
$id = $request->get('id');
$session = Yii::$app->session;
$session->set('subject_id', $id);
$session->set('attempt', $attempt);
echo Dialog::widget([
    'options' => [
        'title' => 'Your Attention pls!',
    ]
]);
echo Dialog::widget();
?>
<style>
    .time-block .card .card-content {
        padding: 10px 0px 7px 0px;
    }   
    .time-block-1, .time-block-2, .time-block-3 {
        width: 30%;
        border: 1px solid #EEE;
        margin: 5px;
        padding-bottom: 0.5%;
    }

    .time-block-1 h1, .time-block-2 h1, .time-block-3 h1, .questions p {
        color: #848484;
        margin: 0;
    }

    .time-block-1 p, .time-block-2 p, .time-block-3 p, .questions p {
        font-weight: 700;
    }

    .time-block-1 {
        border-top: 5px solid #FFA200;
    }

    .time-block-1 p {
        color: #FFA200;
    }

    .time-block-2 {
        border-top: 5px solid #E233FE;
    }

    .time-block-2 p {
        color: #E233FE;
    }

    .time-block-3 {
        border-top: 5px solid #CCDD1D;
    }

    .time-block-3 p {
        color: #CCDD1D;
    } 

    .questions p {
        color: #f5576c;
    }

    .questions h1 {
        color: #000000;
    }

    .card-header {
        width: 60px;
        text-align: center;
        font-size: 20px;
        padding: 2px !important;
        margin: -30px auto 0 !important;
        background-image: linear-gradient(120deg, #f093fb 0%, #f5576c 100%) !important;
    }

    .questions {
        border: 1px solid #EEE;
        width: 80%;
        background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
    }

    .questions .card-title {
        margin-top: 3px;
        margin-bottom: 3px;
    }

    .questions .card-content h1 {
        margin-top: 0;
    }

    .item {
        display: none;
    }

    .item.current {
        display: block;
        min-height: 250px;
    }

    .check-list {
        margin-top: 0;
    }

    .half-column {
        width: 4.16666665%;
        float: left;
        border: 1px solid #f3f3f3;  
    }

    .half-column p  {
        background-color: transparent;
        color: #000000; 
        padding: 7%;
        margin: 20%;
        font-weight: 400;
        cursor: pointer;
    }

    .modal-header {
        background-color: orange;
        color: #FFFFFF;
    }

    .modal .modal-header .close {
        color: #FFFFFF;
    }

    .modal-body h4 {
        font-weight: 500;
    }

    .modal-body {
        min-height: 150px !important;
    }

    .modal-content {
        border-radius: 0 !important;
    }

    .question-block {
        padding: 0;
    }
</style>

<div class="content" id="questions-module">
    <div class="container-fluid">
        <div class="row">
            <?= Html::beginForm(['/timed-quiz/quiz-completion'], 'POST', ['id' => 'timedQuizForm']); ?>
            <div class="col-md-9 question-block">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase"><i class="material-icons">library_books</i> Cyber Security</h4>
                    </div>
                    <div class="card-content"> 
                        <div id="group">
                            <?php
                            $i = 1;

                            foreach ($random_questions as $questions) :
                                if ($i == 1) :
                                    $current = "current";
                                else :
                                    $current = "";
                                endif;
                                ?>
                                <div class="<?= $current ?> item" id="question-block-<?= $i ?>">
                                    <h3><b> <?= $i ?>. <?= $questions->question ?></b></h3>

                                    <?php
                                    $options = explode(",", $questions->options);
                                    $j = 1;
                                    foreach ($options as $option) :
                                        ?>
                                        <h5><input type="radio" class="options_radio" name="quiz_question_<?= $questions->id ?>[answer]" value="<?= $j ?>"> <?= $option ?></h5>
                                        <?php $j++; ?>
                                    <?php endforeach; ?>

                                </div>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </div>

                        <div class="col-md-12 text-center">
                            <?= Html::button('<< Previous', ['class' => 'btn btn-info', 'id' => 'prev', 'style' => 'display:none']) ?>
                            <?= Html::button('Next >>', ['class' => 'btn btn-default', 'id' => 'next']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 time-block">
                <div class="card">
                    <div class="card-content">
                        <center>
                            <div class="card questions text-center">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="card-title"><i class="fa fa-thumb-tack" aria-hidden="true"></i></h4>
                                </div>
                                <div class="card-content">
                                    <h1><?= $total_questions ?></h1>
                                    <p class="text-uppercase">Total Questions</p>
                                </div>
                            </div>
                        </center>
                    </div>

                    <div class="row" style="margin-right:-10%">
                        <div class="col-md-4 time-block-1 text-center">
                            <h1 id="hours">00</h1>
                            <p class="text-uppercase">Hours</p>
                        </div>
                        <div class="col-md-4 time-block-2 text-center">
                            <h1 id="minutes">00</h1>
                            <p class="text-uppercase">Minutes</p>
                        </div>
                        <div class="col-md-4 time-block-3 text-center">
                            <h1 id="seconds">00</h1>
                            <p class="text-uppercase">Seconds</p>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <?= Html::button('Help', ['class' => 'btn btn-danger']) ?>
                          <a href="#" id="deleteModal" data-toggle="modal1" data-target="#deleteModal" title="delete">
                          <button type='button' class='btn btn-success'>Submit</button></a>
                        <?= Html::submitbutton('Submit', ['class' => 'btn btn-success','id'=>'submit_form','style'=>['display'=>'none']]) ?>
                    </div>
                </div>
            </div>
            <?= Html::endForm(); ?>
        </div><br/>

        <div class="card check-list">
            <div class="card-header1 card-header-text" data-background-color="blue">
                <h4 class="card-title text-uppercase">Answer Check List</h4>
            </div>
            <div class="card-content text-center">
                <div class="row">
                    <?php for ($i = 1; $i <= $total_questions; $i++) { ?>
                        <div class="half-column">
                            <p id="answer-block-<?= $i ?>" class="check_list"><?= $i ?></p> 
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>                                                              
                                                                <?php
                                                                Modal::begin([
                                                                    'header' => '<h3 style="margin:0px !important">Confirmation</h3>',
                                                                    'id' => 'modal',
                                                                    'size' => '',
                                                                ]);
                                                                echo "<div id='modalContent'></div>"
                                                                . "<p>Are you sure you want to leave ?</p>";
                                                                echo "<div class='modal-footer'>";
                                                                echo "<a href='#' data-dismiss='modal'>";
                                                                echo "<button type='button' class='btn btn-danger' style='padding: 12px 1px 7px 1px !important; width: 80px !important;'>Close" . "</button>";
                                                                echo "</a>";
                                                                echo "&nbsp;";
                                                                echo 
                                                                "<button type='submit' class='btn btn-success' id='pop_up_submit' style='padding: 12px 1px 7px 1px !important; width: 80px !important;'>Submit</button>"
                                                                . "</a>"
                                                                . "</div>";
                                                                Modal::end();
                                                                ?>
                                                                <script>
                                                                    $(function () {
                                                                        $("#deleteModal").click(function () {
                                                                            $('#modal').modal('show')
                                                                                    .find('#modalContent')
                                                                                    .load($(this).attr('value'));
                                                                        });
                                                                    });

                                                                </script>  
<script type="text/javascript">
// Set the date we're counting down to
    countDownDate = new Date("<?= $duration ?>").getTime();

// Update the count down every 1 second
    x = setInterval(function () {

        // Get todays date and time
        now = new Date().getTime();
        // Find the distance between now and the count down date
        distance = countDownDate - now;      
        // Time calculations for days, hours, minutes and seconds
        days = Math.floor(distance / (1000 * 60 * 60 * 24));
        hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;
        // If the count down is finished, write some text 
        if (distance < 1) {
            $('#submit_form').click();
        }
    }, 1000);
</script>

<script type="text/javascript">
    $(function () {
        $cur = $('#group .current');
        var $items = $('#group .item');

        function hideButtons() {
            $cur = $('#group .current');
            var index = $cur.index();
            if (index > 0) {
                $('#prev').show();
            } else {
                $('#prev').hide();
            }

            if (index < $items.length - 1) {
                $('#next').show();
            } else {
                $('#next').hide();
            }
        }

        $('.half-column p').click(function () {
            id = $(this).text();
          var count = <?= count($random_questions) ?>

         
                if(id > 1 && id < count){
                $('#prev').show();
                $('#next').show();
            }else{
                $('#prev').hide();
                 $('#next').show(); 
            }
           

            if (id == count) {
                $('#prev').show();
                $('#next').hide();
            }

            $('#group .current').removeClass('current');
            $('#question-block-' + id).addClass('current');

            $cur = $('#question-block-' + id);
        });

        $('#next').click(function () {
            $cur.next().addClass('current');
            $cur.removeClass('current');
            hideButtons();
        });
        $('#prev').click(function () {
            $cur.prev().addClass('current');
            $cur.removeClass('current');
            hideButtons();
        });
    });
</script>

<?php
$script = <<< JS
        
$('#pop_up_submit').click(function(){
        $('#submit_form').click();
    });
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };

$('input').change(function() {
    value = $(this).val();
        
    question_name = $(this).attr('name');    
    
    split_question_name = question_name.split('_');
        
    split_name = split_question_name[2].split('[');
        
    question_id = split_name[0];
      
    $.get('capture-quiz-session', {id : question_id, value : value, taken_timed_quiz_id : $taken_timed_quiz_id}, function() {

    });
    
        
    parent_id = $(this).parent().parent().attr('id');
        
    var array = parent_id.split('-');
        
    $('#answer-block-' + array[2]).css({
        "background-color" : "#15c796",
        "border-radius" : "50%",
        "color" : "#FFFFFF"        
   });
}); 
 
window.onbeforeunload = function () {
          $("#timedQuizForm").submit();  
}

JS;
$this->registerJs($script);
?>


