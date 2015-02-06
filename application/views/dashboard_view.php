      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>versi 2.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- info selamat datang -->
          <div class="alert alert-info alert-dismissable" style="padding:5px 35px 5px 5px; margin: 0 0 5px 0">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <b>Hai!</b> <?=$welcome_message;?>
          </div>
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Artikel</span>
                  <span class="info-box-number" id="boxtotalpost">0</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-comments"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Komentar</span>
                  <span class="info-box-number" id="boxtotalcomment">0</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-exclamation-circle"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Notifikasi</span>
                  <span class="info-box-number" id="boxnotif">0</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Penulis</span>
                  <span class="info-box-number" id="boxauthor">0</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- MAP & BOX PANE -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Pengunjung</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-9 col-sm-8">
                      <div class="pad">
                        <!-- Map will be created here -->
                        <div id="world-map-markers" style="height: 325px;"></div>
                      </div>
                    </div><!-- /.col -->
                    <div class="col-md-3 col-sm-4">
                      <div class="pad box-pane-right bg-green" style="min-height: 280px">
                        <div class="description-block margin-bottom">
                          <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                          <h5 class="description-header">8390</h5>
                          <span class="description-text">Visits</span>
                        </div><!-- /.description-block -->
                        <div class="description-block margin-bottom">
                          <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                          <h5 class="description-header">30%</h5>
                          <span class="description-text">Referrals</span>
                        </div><!-- /.description-block -->
                        <div class="description-block">
                          <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                          <h5 class="description-header">70%</h5>
                          <span class="description-text">Organic</span>
                        </div><!-- /.description-block -->
                      </div>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

          <div class='row'>
            <div class="col-md-4">
              <!-- PRODUCT LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Artikel Terbaru</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <?php 
                        foreach ($dataartikel->result() as $key) { 
                    ?>
                    <li class="item">
                      <div class="product-img">
                        <img src="<?=base_url() . "public/img/post/" . $key->post_pic;?>" alt="<?=$key->post_title;?>"/>
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title"><?=$key->post_title;?> 
                        <span class="label label-info pull-right"><?php
                                            $tag = explode(',', $key->post_tag);
                                            foreach ($tag as $a => $value) {
                                                echo "#".$value." ";
                                            }
                                        ?>
                          </span></a>
                        <span class="product-description">
                          <?=$this->access->string_trim($key->post_content,100);?>
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <?php } ?>
                    
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?=base_url();?>dashboard/artikel" class="uppercase">Lihat Semua Artikel</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class='col-md-4'>
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Penulis Terbaru</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php 
                        foreach ($datapenulis->result() as $key) { 
                    ?>
                    <li>
                      <img src="<?=base_url() . "public/img/" .$key->user_ava;?> " alt="User Image"/>
                      <a class="users-list-name" href="#"><?=$key->user_name;?></a>
                      <span class="users-list-date"><?= date("d-m-Y", strtotime($key->user_created));?> </span>
                    </li>
                    <?php } ?>
                    
                  </ul><!-- /.users-list -->
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?=base_url();?>dashboard/user" class="uppercase">Lihat Semua User</a>
                </div><!-- /.box-footer -->
              </div><!--/.box -->
            </div><!-- /.col -->
            <div class="col-md-4">
              <!-- PRODUCT LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Komentar Terbaru</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <?php 
                        foreach ($datakomen->result() as $key) { 
                    ?>
                    <li class="item">
                      <div class="product-img">
                        <img src="<?=base_url();?>public/img/avatar5.png" alt="<?=$key->comment_name;?>"/>
                      </div>
                      <div class="product-info">
                        <a href="javascript::;" class="product-title"><?=$key->comment_name;?> 
                        <span class="label label-info pull-right"><?=$key->comment_date;?></span></a>
                        <span class="product-description">
                          <?=$this->access->string_trim($key->comment_text,100);?>
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <?php } ?>
                    
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?=base_url();?>dashboard/komentar" class="uppercase">Lihat Semua Komentar</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 timecms template by <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> Rendered in <i>{elapsed_time} sec</i>, with {memory_usage}. From <?=$this->input->ip_address();?>
      </footer>

    </div><!-- ./wrapper -->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?=base_url();?>public/js/pages/dashboard2.js" type="text/javascript"></script>

    <script type="text/javascript">
          function refresh_jumlah(){
              $.getJSON('<?=site_url()?>/dashboard/get_databox', function(obj) {
                  $("#boxtotalpost").html(obj.boxtotalpost);
                  $("#boxtotalcomment").html(obj.boxtotalcomment);
                  $("#boxnotif").html(obj.boxnotif);
                  $("#boxauthor").html(obj.boxauthor);
              });
          }

          $(document).ready(function() {
              refresh_jumlah();
              var auto_refresh = setInterval(
                  function(){
                      refresh_jumlah();
                  }, 10000
              )
          });
      </script>

  </body>
</html>