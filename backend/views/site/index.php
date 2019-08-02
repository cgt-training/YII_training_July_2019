<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Company</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Company Name</th>
                    <th>Total Branch</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    foreach ($dashboard->getLatestCompany() as $company) {
                    ?>    
                    <tr>
                    <td><?=$company['company_name']?></td>
                    <td><?=$company['total_branch']?></td>
                    <td><span class="label label-success"><?=$company['company_status']?></span></td>
                    <td>
                      <a href="<?php echo Url::toRoute(['company/view', 'id' =>$company['company_id'] ]); ?>"><span class="label label-primary"><?='view';?></span></a>
                    </td>
                  </tr>

                   <?php

                    }
                  ?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>

    </div>
</div>
