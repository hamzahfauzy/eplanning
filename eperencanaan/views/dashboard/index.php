<?php include"header.php"; ?>
		<div class="page-title" id="tour-step-4">
            <img src="img/headereperencanaan.png" class="img-responsive">
        </div>
		<div class="row">
            <div class="col-lg-12">
                <h3></h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <span id="usulankel">
                                            <?= number_format($usulanKel,"0", ",", ".") ?></span>
                                        </div>
                                    <div>Usulan Musrenbang Desa/Kelurahan!</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right"></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comment fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <span id="usulankec">
                                          <?= number_format($jumlahUsulanKec,"0", ",", ".") ?>
										<!-- <?= number_format($usulanKecPro,"0", ",", ".") ?> -->
                                        </span>
                                    </div>
                                    <div>Usulan Musrenbang Kecamatan!</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right"></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
				
				<div class="col-lg-4 col-md-6 d-flex">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <span id="usulanpokir">
                                            <?= number_format($jumlahUsulanPokir,"0", ",", ".") ?>
                                        </span>
                                    </div>
                                    <div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Total Usulan Pokir</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right"></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="row">
				<div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <span id="usulanopd">
                                            <?= number_format($jumlahUsulanOPD1,"0", ",", ".") ?>
                                        </span>
                                    </div>
                                    <div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Usulan Diproses / Forum Perangkat Daerah</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right"></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
				
				<div class="col-sm-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-basket  fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <span id="jumlahkegiatan">
                                            <?= number_format($jumlahKegiatan,"0", ",", ".") ?>
                                        </span>
                                    </div>
                                    <div>Total Usulan OPD</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right"></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
			<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Rekap Musrenbang
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                    <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="tbl-rekap" class="table-responsive">Loading...</div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
			</div>
			<script src="/kamususulan/views/js/jquery.js"></script>
			<script>
			$(document).ready(function(){
				$.get("index.php?r=dashboard/rekap",function(response){
					if(response)
						$("#tbl-rekap").html(response);
				});
                loadData();
                setTimeout(loadData(),5000);
			});
            function loadData(){
                $.get("index.php?r=dashboard/load-data",function(response){
                    if(response){
                        $("#usulanKel").html(response.usulankel);
                        $("#usulanKec").html(response.usulankec);
                        $("#usulanPokir").html(response.usulanpokir);
                        $("#usulanopd").html(response.usulanopd);
                        $("#jumlahkegiatan").html(response.jumlahkegiatan);
                    }
                },"json");
            }
			</script>
<?php include"footer.php"; ?>