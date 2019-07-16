 <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
	  
	  <?php session_start(); if(isset($_SESSION['nome'])) {?>
	    <div class="dropdown">
		<button type="button"  style="border:0px;background-color: transparent; color:black" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		 <span>
			  <i class="fas fa-user" style="color:#6c757d"></i>
			  <span style="font-size:14px"><?php echo $_SESSION['nome']; ?> </span>
		 </span>
		</button>
		<div class="dropdown-menu">
		  <a class="dropdown-item" href="<?php echo base_url(); ?>?p=sair&typ=2">Sair</a>
		</div>
		</div>
	   <?php }else{ ?>
        <a class="nav-link" onclick="showmodal()" href="#">
          <i class="fas fa-user"></i>
		  <span style="font-size:14px">Entre ou Cadastre</span>
        </a>
	   <?php } ?>
      </li>
	   <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
   <?php if(!isset($_SESSION['nome'])) { ?>
  <div class="modal fade" id="modal-login">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Login</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			    <form role="form" method="post" action="?p=usuarios&typ=2" enctype="multipart/form-data">
                <div class="card-body">
				  <i style="margin:0 0 10px 40%;font-size: 90px;color:#343a40" class="fas fa-user"></i>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-4 control-label">Email</label>
					<div class="col-sm-12">
						<div class="input-group mb-0">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="email" name="email" class="form-control" placeholder="Email">
						</div>
					</div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-4 control-label">Senha</label>

					<div class="col-sm-12">
						<div class="input-group mb-0">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="senha" class="form-control" placeholder="Senha">
						</div>
					</div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Relembrar</label>
                      </div>
                    </div>
                  </div>
				  <p id="errorMessage" style="visibility: hidden;display: none;color:red">Email ou senha incorretos*</p>
                </div>
                <!-- /.card-footer -->
             
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			  <div>
			  <button type="submit" name="Logar" class="btn btn-primary">Logar</button>
			  </div>
            </div>
          </div>
		  </form>
         </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
   </div>
   <?php } ?>