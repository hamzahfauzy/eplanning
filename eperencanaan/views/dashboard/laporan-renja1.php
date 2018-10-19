<?php include"header.php"; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
                                <h3>Laporan Rencana Kerja</h3>
                            </div>
                            <div class="row">
                                <form id="form_cari">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label >Sub Unit</label>
                                            <select class="form-control" name="Kd_Sub" id="sub-unit">
                                               
                                                <?php foreach ($subunit as $key => $value): ?>
                                                    <option value="<?= $value->Kd_Urusan.'.'.$value->Kd_Bidang.'.'.$value->Kd_Unit.'.'.$value->Kd_Sub ?>"><?= $value->Nm_Sub_Unit ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label >&nbsp;</label>
                                            <button type="button" class="form-control btn btn-success" id="btn-lihat-laporan-renja">Lihat</button>
                                        </div>
                                    </div>
									<!--<div class="col-md-2">
                                        <div class="form-group">
                                            <label >&nbsp;</label>
                                            <button type="button" class="form-control btn btn-success" id="btn-lihat-laporan-renja-ranwal">Ranwal</button>
                                        </div>
                                    </div> -->
                                </form>
                            </div>
                            
                            
                            <div class="row" id="isi-wrap">

                            </div>

                        </div>
                    </div>
                </div>
<?php include"footer.php"; ?>