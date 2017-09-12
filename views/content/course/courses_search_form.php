      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Busca por cursos</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
		  
            <!-- /.col -->
            <div class="col-md-4">
                <div class="form-group">
                  <label>Título</label>
                  <input type="text" id="search_form_title" class="form-control" placeholder="Palavra chave...">
                </div>
              <!-- /.form-group -->
			</div>  
			
            <div class="col-md-4">
              <div class="form-group">
                <label>Categoria</label>
                <select class="form-control select2" id="search_form_category" style="width: 100%;">
					<option value="0">Todos</option>
					<?php
						$retorno_categorias = ExecData($mysqli, 'cursos','curso_categorias_lista','*', 0);
						while($categorias = mysqli_fetch_array($retorno_categorias))
						{
							echo 
							'
								<option value="'.$categorias['curso_categoria_id'].'">'.$categorias['curso_categoria_nome'].'</option>
							';
						}
					?>
                </select>
              </div>
            </div>
			 
				<div class="col-md-2">
					<div class="form-group">
						<label><BR><BR></label>
						<button type="button" class="btn btn-primary btn-md " id="courses_list_search"><i class="fa fa-search"></i> Buscar</button>
					</div>
				</div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

 