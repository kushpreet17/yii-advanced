<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <?php foreach($courses as $course):?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <?php echo $course->course_name?>
        </a>
<div class="pull-right">        
<a class="icon-block" data-type="edit" data-toggle="modal" data-id="<?php echo $course->id?>" data-target="#educationBlock"><span ><i class="glyphicon glyphicon-pencil" aria-hidden="true" ></i></span></a>
<a class="icon-block" data-type="delete" data-toggle="modal" data-id="<?php echo $course->id?>" data-target="#courseDeleteBlock"><span ><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></span></a>
</div>        
      </h4>

    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
          Year: <?php echo $course->year?>
          <br/>
          University: <?php echo $course->university?> 
      </div>
    </div>
  </div>
  <?php endforeach?>
</div>

