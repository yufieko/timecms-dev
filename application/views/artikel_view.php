      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Artikel
            <small>Daftar artikel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Artikel</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- info selamat datang -->
          <div class="alert alert-info alert-dismissable" style="padding:5px 35px 5px 5px; margin: 0 0 5px 0">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              Di halaman ini kamu bisa melihat semua artikel dan dapat mengolahnya
          </div>

          <!-- Info boxes -->
          <div class="row connectedSortable">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3 id="boxpublish">0</h3>
                  <p>Publish</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check-square-o"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3 id="boxdraft">0</h3>
                  <p>Draft</p>
                </div>
                <div class="icon">
                  <i class="fa fa-times-circle"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3 id="boxartikel">0</h3>
                  <p>Total Artikel</p>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3 id="boxsuka">0</h3>
                  <p>Total Suka</p>
                </div>
                <div class="icon">
                  <i class="fa fa-thumbs-o-up"></i>
                </div>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- MAP & BOX PANE -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"> </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-sm btn-info" id="btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <button class="btn btn-sm btn-success" id="btn-tambah-artikel"><i class="fa fa-plus"></i> Buat Artikel Baru</button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table-artikel" class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Judul</th>
                              <th>Penulis</th>
                              <th>Dibuat</th>
                              <th>Status</th>
                              <th>Opsi</th>
                          </tr>
                      </thead>
                  </table>
                </div><!-- /.box-body -->
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

    <!-- Modal Hapus Artikel -->
      <div class="modal modal-danger fade" id="modal-hapus" data-backdrop="static">
          <div class="modal-dialog" style="width: 350px;">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><i class="fa fa-book"></i> Hapus Artikel</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body table-responsive">
                          <span id="form-pesan-hapus">
                          </span>
                          <?php echo form_open('agenda/hapus', 'id="form-hapus"') ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-12">
                                          <input type="hidden" id="hapus-id" name="hapus-id" />
                                          <input type="hidden" id="hapus-uname" name="hapus-uname" />
                                          <p>Apakah Anda yakin ingin menghapus Artikel berikut ?</p>
                                          <div class="callout callout-danger">
                                              <p>Judul : <span id="hapus-nama"> </span></p>
                                              <p>Penulis : <span id="hapus-penulis"> </span></p>
                                          </div>

                                  </div>
                              </div>
                          </div>
                          <?php echo form_close(); ?>
                      </div><!-- /.box-body -->
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                      <button id="btn-hapus" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Iya, Hapus</button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Modal Edit Artikel -->
      <div class="modal fade" id="modal-edit" data-backdrop="static">
          <div class="modal-dialog" style="width: 50%;">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><i class="fa fa-book"></i> Edit Artikel</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body table-responsive">
                          <span id="form-pesan-edit">
                          </span>
                          <?php echo form_open_multipart('agenda/edit', 'id="form-edit"') ?>
                          <input type="hidden" id="edit-id" name="edit-id" readonly="" />
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">Judul:</span>
                                        <input type="text" class="form-control" id="edit-judul" name="edit-judul" placeholder="Judul Artikel" />
                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                      <textarea name="edit-teks" id="edit-teks" class="form-control" placeholder="Isi Artikel" style="height: 100px;overflow:auto;resize:none"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">Tag:</span>
                                        <input type="text" class="form-control" id="edit-tag" name="edit-tag" placeholder="Tag, Jika lebih dari 1 pisahkan dengan koma" />
                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">Status:</span>
                                        <select class="form-control" id="edit-status" name="edit-status">
                                            <option value="1">Publish</option>
                                            <option value="0">Draft</option>
                                        </select>

                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="edit-attachment" id="edit-attachment"/>  
                                        <p class="help-block">Gambar Maks. 1MB</p>
                                    </div>


                                  </div>
                              </div>
                              <?php echo form_close(); ?>
                          </div><!-- /.box-body -->
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                      <button id="btn-edit" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  </div>
              </div>
          </div>
      </div> <!-- /.modal-edit -->

      <!-- Modal Tambah Artikel -->
      <div class="modal fade" id="modal-tambah" data-backdrop="static">
          <div class="modal-dialog" style="width: 50%;">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><i class="fa fa-book"></i> Buat Artikel Baru</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body table-responsive">
                          <span id="form-pesan-tambah">
                          </span>
                          <?php echo form_open_multipart('agenda/tambah', 'id="form-tambah"') ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">Judul:</span>
                                        <input type="text" class="form-control" id="tambah-judul" name="tambah-judul" placeholder="Judul Artikel" />
                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">Waktu:</span>
                                        <input type="text" class="form-control" id="tambah-time" name="tambah-time" placeholder="Waktu Artikel" value="<?=date("Y-m-d H:i:s",now());?>" />
                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                      <textarea name="tambah-teks" id="tambah-teks" class="form-control textarea" placeholder="Isi Artikel" style="height: 100px;overflow:auto;resize:none"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">Tag:</span>
                                        <input type="text" class="form-control" id="tambah-tag" name="tambah-tag" placeholder="Tag, Jika lebih dari 1 pisahkan dengan koma" />
                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">Status:</span>
                                        <select class="form-control" id="tambah-status" name="tambah-status">
                                            <option value="1">Publish</option>
                                            <option value="0">Draft</option>
                                        </select>

                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="tambah-attachment" id="tambah-attachment"/>  
                                        <p class="help-block">Gambar Maks. 1MB</p>
                                    </div>


                                  </div>
                              </div>
                              <?php echo form_close(); ?>
                          </div><!-- /.box-body -->
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                      <button id="btn-simpan" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  </div>
              </div>
          </div>
      </div> <!-- /.modal-tambah -->

        <script type="text/javascript">
            function modaledit(id, judul, status, teks, tag){
                // var editor = new wysihtml5.Editor("edit-teks", {
                //   toolbar:      "toolbar",
                //   parserRules:  wysihtml5ParserRules
                // });
                $('#edit-id').val(id);
                $('#edit-judul').val(judul);
                //$('#edit-teks').val("teks");
                $('#edit-teks').wysihtml5().data("wysihtml5").editor.setValue(teks);

                $('#edit-tag').val(tag);
                $("#edit-status option").filter(function(){
                    return ( ($(this).val() == status) || ($(this).text() == status) );
                }).prop('selected', true);
                $('#modal-edit').modal('show');
            }

            function modalhapus(id, judul, penulis){
                $('#form-pesan-hapus').html('');
                $('#modal-hapus').modal('show');
                $('#hapus-id').val(id);
                $('#hapus-uname').val(judul);
                $('#hapus-nama').html(judul);
                $('#hapus-penulis').html(penulis);
            }

            function refresh_jumlah(){
              $.getJSON('<?=site_url()?>/artikel/get_databox', function(obj) {
                  $("#boxpublish").html(obj.boxpublish);
                  $("#boxdraft").html(obj.boxdraft);
                  $("#boxartikel").html(obj.boxartikel);
                  $("#boxsuka").html(obj.boxsuka);
              });
            }

            $(document).ready(function() {
                //$('#tambah-time').daterangepicker({timePicker: true, timePickerIncrement: 1, format: 'YYYY-MM-DD hh:mm:ss', separator: ' sampai '});
                /*$('#tambah-time').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true
                });*/
                
                $(".textarea").wysihtml5();

                refresh_jumlah();
                $('#btn-refresh').click(function(){
                    $('#table-artikel').dataTable().fnReloadAjax();
                    refresh_jumlah();
                });

                $('#modal-hapus').on('shown.bs.modal', function (e) {
                    $('#btn-hapus').focus();
                });

                $('#modal-edit').on('shown.bs.modal', function (e) {
                    $('#edit-nama').focus();
                });

                $('#btn-tambah-artikel').click(function(){
                    $('#form-pesan-tambah').html('');
                    $('#modal-tambah').modal('show');
                });

                $('#table-artikel').dataTable({
                    "sPaginationType": "bootstrap",
                    "bProcessing": false,
                    "bLengthChange": false,
                    "bServerSide": true,
                    "bJQueryUI": true,
                    "iDisplayLength":6,
                    "bAutoWidth": false,
                    "sAjaxSource": "<?=site_url()?>/artikel/getartikel",
                    "aoColumns": [
                            {"bSearchable": true, "bSortable": false, "sWidth": 30},
                            {"bSearchable": true, "bSortable": false},
                            {"bSearchable": true, "bSortable": false, "sWidth": 120},
                            {"bSearchable": true, "bSortable": false, "sWidth": 120},
                            {"bSearchable": true, "bSortable": false, "sWidth": 50},
                            {"bSearchable": false, "bSortable": false, "sWidth": 160}
                    ],

                });

                // Tambah artikel
                $('#btn-simpan').click(function(){
                    $('#form-tambah').submit();
                    $('#btn-simpan').addClass('disabled');
                });
                $('#form-tambah').submit(function(){
                    // create a FormData Object using your form dom element
                    var form = new FormData(document.getElementById('form-tambah'));
                    //append files
                    var file = document.getElementById('tambah-attachment').files[0];
                    if (file) {   
                      form.append('tambah-attachment', file);
                    }

                    $.ajax({
                        url:"<?=site_url()?>/artikel/tambah",
                        type:"POST",
                        data:form,
                        cache: false,
                        contentType: false, //must, tell jQuery not to process the data
                        processData: false, //must, tell jQuery not to set contentType
                        success:function(respon){
                            var obj = $.parseJSON(respon);
                            if(obj.status==1){
                                $('#form-pesan-tambah').html(pesan_succ(obj.pesan));
                                setTimeout(function(){$('#form-pesan-tambah').html('')}, 2000);
                                setTimeout(function(){$('#modal-tambah').modal('hide')}, 2500);
                                setTimeout(function(){ $('#table-artikel').dataTable().fnReloadAjax(); refresh_jumlah(); }, 2500);
                            }else{
                                $('#form-pesan-tambah').html(pesan_err(obj.pesan));
                                setTimeout(function(){$('#form-pesan-tambah').html('')}, 5000);
                            }

                            $('#btn-simpan').removeClass('disabled');
                        }
                    });
                    return false;
                });

                // Hapus artikel
                $('#btn-hapus').click(function(){
                    $('#form-hapus').submit();
                    $('#btn-hapus').addClass('disabled');
                });
                $('#form-hapus').submit(function(){
                    $.ajax({
                        url:"<?=site_url()?>/artikel/hapus",
                        type:"POST",
                        data:$('#form-hapus').serialize(),
                        cache: false,
                        success:function(respon){
                            var obj = $.parseJSON(respon);
                            if(obj.status==1){
                                $('#form-pesan-hapus').html(pesan_succ(obj.pesan));
                                setTimeout(function(){$('#form-pesan-hapus').html('')}, 2000);
                                setTimeout(function(){$('#modal-hapus').modal('hide')}, 2500);
                                setTimeout(function(){ $('#table-artikel').dataTable().fnReloadAjax(); refresh_jumlah(); }, 2500);
                            }else{
                                $('#form-pesan-hapus').html(pesan_err(obj.pesan));
                                setTimeout(function(){$('#form-pesan-hapus').html('')}, 5000);
                            }

                            $('#btn-hapus').removeClass('disabled');
                        }
                    });
                    return false;
                });

                // Edit artikel
                $('#btn-edit').click(function(){
                    $('#form-edit').submit();
                    $('#btn-edit').addClass('disabled');
                });

                $('#form-edit').submit(function(){
                    $.ajax({
                        url:"<?=site_url()?>/artikel/edit",
                        type:"POST",
                        data:$('#form-edit').serialize(),
                        cache: false,
                        success:function(respon){
                            var obj = $.parseJSON(respon);
                            if(obj.status==1){
                                $('#form-pesan-edit').html(pesan_succ(obj.pesan));
                                setTimeout(function(){$('#form-pesan-edit').html('')}, 2000);
                                setTimeout(function(){$('#modal-edit').modal('hide')}, 2500);
                                setTimeout(function(){ $('#table-artikel').dataTable().fnReloadAjax(); refresh_jumlah(); }, 2500);
                            }else{
                                $('#form-pesan-edit').html(pesan_err(obj.pesan));
                                setTimeout(function(){$('#form-pesan-edit').html('')}, 2000);
                            }

                            $('#btn-edit').removeClass('disabled');
                        }
                    });
                    return false;
                });
            });
        </script>

  </body>
</html>