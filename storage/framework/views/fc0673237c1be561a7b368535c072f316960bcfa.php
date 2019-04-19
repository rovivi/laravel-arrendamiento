<head>
    <meta charset="utf-8">
    <title>Cotización</title>
    <link rel="stylesheet" href="../css/spin.css">    
</head>

<script> let id = <?php echo e($id); ?>;</script>
<?php $__env->startSection('header'); ?>
    <section class="content-header">
      <h1>
      Cotización <small>Contrato <?php echo e($id); ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(backpack_url()); ?>"><?php echo e(config('backpack.base.project_name')); ?></a></li>
        <li class="active">Cotización</li>
      </ol>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    
    <div class="form " id="formselect">
        <div class="app" v-show="loaded"  style=" display: none;">
            <div class="row ">
                <!-- Selector--->

                <div class="col col-md-6 paper ">
                    <div class="topnav">
                        
                    	<label class="float-left"><h3 >Servicios</h3></label>
                        <input class="float-right" type="text" placeholder="Buscar servicio" v-model="searchText">
                    </div>
                    <div class="row ">
                        <div class="col col-md-5 ">
                            <label><h5>Nombre/Description</h5></label>
                        </div>
                        <div class="col col-md-5">
                            <label><h5>Cantidad</h5></label>
                        </div>
                    </div>
                    <lista v-for="service in serviceSearch()" :service="service" />
                </div>
                <div class="col col-md-6  position-fixed center pre-scrollable   ">
                	<label><h3>Cotización</h3></label>
                    <div class="row container-fluid " style="  height: 100%;">
                        <table-active :services="activeService()"  :total="totalCoti()" inline-template>
                            <div class="paper">
                                <table class="table table-striped table-dark"   >
                                    <thead >
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Unidades</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>                               
                                <tbody>
                                    <tr v-for="service in services">
                                        <th scope="row">{{service.name}}</th>
                                        <td>{{service.count}}</td>
                                        <td>${{service.count *service.price}}</td>
                                        <td><label class="btn btn-danger">Eliminar</label> </td>                                        	
                                    </tr>                                    	
                                    <tr >
                                        <th scope="row"></th>
                                        <td>Total</td>
                                        <td>${{total}}</td>                                        
                                        <td><label class="btn btn-success" v-on:click="hola">Guardar</label></td>
                                    </tr>                                    
                                </tbody>
                                </table>                            	
                            </div>                            
                        </table-active>
                    </div>
                </div>
            </div>            
        </div>       
        <!--<spinner class= "spinner"></spinner> -->
        <div class="loader" v-if="!loaded">Cargando...</div>
    </div>
    <!-- Scripts---->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
    <script src="../js/loader.js"></script>
    <!---------Templates----------------------->
    <template id="table-temp">
    </template>
    <template id="lista-template">
        <div class="row">
            <div class="col col-md-4">
                <b>{{service.name}}</b>
                <br>{{service.description}}
            </div>
            <div class="col col-md-6">
                <input v-model="service.count" type="number" class="form-control" maxlength="12 " min="0" width="48" value="0">
            </div>
        </div>
    </template>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backpack::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>