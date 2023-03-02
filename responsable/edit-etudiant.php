<?php session_start();
if(empty($_SESSION['logged']) || $_SESSION['logged']!=1)
{
    header("Location: ../connexion/page-404.html");
    exit;
    }
    else{?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="../assets/images/logo_dark.png">

        <title>Etudiants</title>
        
        <link href="../assets/plugins/bootstrapvalidator/src/css/bootstrapValidator.css" rel="stylesheet" type="text/css" />

        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />




        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

        <![endif]-->
         <link href="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="../assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
        <link href="../assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <script src="../assets/js/modernizr.min.js"></script>
        
    </head>

 <?php include_once('DB_connect.php'); ?>
    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">

           

            <!-- Top Bar Start -->
            <div class="topbar">
             <div high=" 100px"class="topbar-left">
                    <div class="text-center">
                        <a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span><img class="logoensat" src="../assets/images/logo_dark.png"/>F<i class="md md-album"></i>rmati<i class="md md-album"></i>ns c<i class="md md-album"></i>ntinues</span></a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                         <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                               
                            </div>


               <?php 
               



               $env='0';
               $req1 = $bdd->prepare('SELECT COUNT(*) as total FROM demande_attestation WHERE envoye=? AND cin_respo=?'); 
               $req1->execute(array($env,$_SESSION['cin']));
              $data=$req1->fetch();
 ?> 
                 
                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#"  class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger"><?= $data['total']; ?></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="notifi-title"><span class="label label-default pull-right">New <?= $data['total']; ?></span>Demandes d'attestation</li>
                                        <li class="list-group nicescroll notification-list">
                              <?php 
                            
                            $req1->closeCursor();

              $req2 = $bdd->prepare('SELECT nom,prenom,type_for,specialite_for FROM etudiant,demande_attestation WHERE etudiant.cin=demande_attestation.cin AND demande_attestation.envoye=? AND cin_respo=?'); 
               $req2->execute(array($env,$_SESSION['cin']));
                            while($data2=$req2->fetch())
                              { ?>
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-bell-o fa-2x text-danger"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading"></h5>
                                                    <p class="m-0">
                                                        <small><?= $data2['nom'];?> <?= $data2['nom'];?> : <?= $data2['type_for']; ?> : <?= $data2['specialite_for'];?> </small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                        <?php     
                             }
                         $req2->closeCursor();
                                  ?>       
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="list-group-item text-right">
                                                <small class="font-600">See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                                <?php 
                                        $cin=$_SESSION['cin'];
                                       $req = $bdd->prepare('SELECT * FROM professeur WHERE cin= ?'); 
                                       $req->execute(array($cin));

                                   while($data=$req->fetch())
                                 {?>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="hidden-xs">
                                     
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?= $data['PHOTO'];?>" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                          <li><a href="index.php"><i class="ti-user m-r-5"></i> Profile</a></li>
                                        <li><a href="setting.php"><i class="ti-settings m-r-5"></i> settings</a></Li>
                                        <li><a href="../connexion/lockscreen2.php?cin=<?= $data['CIN'] ?>&amp;photo=<?= $data['PHOTO'] ?>"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
                                         <li><a href="../connexion/deconnexion.php"><i class="ti-power-off m-r-5"></i> logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                  <!--  inssertion progfile right-->
           
                 
                    <?php }
                    $req->closeCursor();?>
                    <div id="sidebar-menu">
                        <ul>

                           <li class="text-muted menu-title">Navigation</li>

                             <li class="has_sub">
                                <a href="#" class="waves-effect active"><i class="ti-home"></i> <span> Accueil</span> </a>
                                 <ul class="list-unstyled">
                                    <li ><a href="index.php">Profil</a></li>
                                     
                                    <li><a href="evenement.php"> Evenements</a></li>
                                
                                </ul>
                            </li>
                             <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i><span> Ajouts </span></a>
                                <ul class="list-unstyled">
                        
                                    <li><a href="form-Professeur.php">Ajout d'Un Professeur</a></li>
                                    <li><a href="form-Etudiant.php">Ajout d'Un Etudiant</a></li>
                                    <li><a href="form-Module.php">Ajout d'Un Module</a></li>
                                    <li><a href="form-Matiere.php">Ajout d'Une Matière</a></li>
                                </ul>
                            </li>
                           
                              <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="ti-menu-alt"></i><span>Liste </span></a>  
                                <ul class="list-unstyled">
                                  
                                    <li><a href="liste-Professeur.php">Liste Des Professeurs</a></li>
                                    <li><a href="liste-Etudiant.php">Liste Des Etudiants</a></li>
                                </ul>
                            </li>
                             <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="ti-bar-chart"></i><span> Statistiques</span></a>
                                <ul class="list-unstyled">
                                  <li><a href="statistique.php">Statistiques</a></li>
                                    <li><a href="liste-archive.php">Archive</a></li>
                                     </ul>
                            </li>
                         

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
              <div class="col-sm-12">
                <h4 class="page-title">Modification</h4>
           
              
              </div>
            </div>
            <?php $req3=$bdd->prepare('SELECT * FROM etudiant WHERE CIN=? ');
                  $req3->execute(array($_GET['cin']));
                  $data3=$req3->fetch();
                  ?>
                        <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="p-20">
                        <form action="etudiant-update.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>Nom*</label>
                            <input required="required" type="text" value="<?= $data3['NOM'] ?>" name="nom" class="form-control">
                            
                          </div>
                          <div class="form-group">
                            <label>Prenom*</label>
                            <input required="required" type="text" value="<?= $data3['PRENOM'] ?>"  name="prenom" class="form-control">
                            
                          </div>
                          <div class="form-group">
                            <label>CNE</label>
                            <input type="text" value="<?= $data3['CNE'] ?>"  name="cne" class="form-control">
                            
                          </div>
                          
                          <div class="form-group m-b-0">
                            <label>Ville de naissance </label>
                            <input type="text" value="<?= $data3['LIEU_N'] ?>"  name="ville" class="form-control">
                            
                          </div>
                          <div class="form-group m-b-0">
                            <label>Date de naissance</label>
                            <input  type="date" value="<?= $data3['DATE_N'] ?>"   name="naissance" class="form-control">
                            
                          </div>
                          <br/>
                      <div class="form-group m-b-0">
                            <label>Sexe </label>

                            <select class="selectpicker" data-style="btn-primary btn-custom" name="sexe">
                             <?php
                              if($_GET['sexe']=='M')
                              {
                              echo' <option  selected value="M">M</option>';
                              }
                             else 
                             {
                               echo' <option  selected value="F">F</option>';
                            }?>
                              </select> 
                          </div>
                          <br/>
                                <div class="form-group m-b-0">
                            <label>Type du Baccalaureat </label>
                            <input required="required" required="required" type="text"  name="bactype" value="<?= $data3['TYPE_BAC'] ?>"  class="form-control">
                            
                          </div>

                           <div class="form-group m-b-0">
                            <label> Date du Baccalaureat</label>
                            <input   name="datebac" type="txt" value="<?= $data3['DATE_BAC'] ?>"  class="form-control">
                            
                          </div>
                          <br/>
    
                        <!--</form>-->
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="p-20">

                   
                           <div class="form-group m-b-0">
                            <label>Type de diplome </label>
                        
                             <select class="selectpicker" data-style="btn-primary btn-custom" name="diplome">
                              <?php
                              if($_GET['typediplome']=='Deug')
                              {
                              echo' <option  selected value="Deug">Deug</option>';
                              }
                             else 
                             {
                               echo' <option  selected value="Licence">Licence</option>';
                            }?>
                              </select> 
                            </div>
                            <br/>

                          
                               <div class="form-group m-b-0">
                            <label>date de diplome </label>
                            <input  type="text" name="datediplome" value="<?= $data3['date_diplome'] ?>"  class="form-control">
                          </div>
                         
                       
                            
                            
                       

                           <div class="form-group m-b-0">
                              <input required="required" type="hidden" value="<?= $_GET['cin']?>" name="cin" >
                            <label>Montant Formation* </label>
                            <input required="required" type="text" value="<?= $data3['montant_for'] ?>" name="montant" data-mask="99-99999999" class="form-control">
                            <input type="hidden" name="old_montant" value="<?= $data3['montant_for'] ?>">
                          </div>
                           <div class="form-group m-b-0">
                            <label>Montant Reste </label>
                            <input  type="text" value="<?= $data3['montant_rest'] ?>" name="montant_rest" data-mask="99-99999999" class="form-control">
                            
                          </div>
                          <div class="form-group m-b-0">
                            <label>Tel </label>
                            <input  type="text" value="<?= $data3['TEL'] ?>" name="tel" data-mask="99-99999999" class="form-control">
                            
                          </div>
                          <div class="form-group m-b-0">
                            <label>Email* </label>
                            <input required="required" type="text" value="<?= $data3['EMAIL'] ?>" name="email" class="form-control" id="inputEmail3">
                            
                          </div>
                           <div class="form-group m-b-0">
                            <label> Adresse </label>
                            <input  name="adresse" type="txt" value="<?= $data3['ADRESSE'] ?>"  class="form-control">
                            
                          </div>

                          <div class="form-group m-b-0">
                            <label class="control-label">Photo*</label>
                            <input  type="file" name="photo" value="<?= $data3['PHOTO'] ?>" class="filestyle" data-buttonname="btn-primary">
                          </div>
                        <br/>
                    
                     <?php
                     $req3->closeCursor();
                    
                   ?>
                          <div class="form-group text-right m-b-0">
                          <br>
                      <button class="btn btn-primary waves-effect waves-light" name="update" type="submit">
                        Enregistrer 
                      </button>
                      <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                        Annuler 
                      </button>
                    </div>
                    
    
                    </div>
                    </div>
                    </form>
                    
                  </div>
                  
                </div>
              </div>
            </div>
           
            
            

                <footer class="footer">
                    2015 © Ensat.
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
           
            <!-- /Right-bar -->


        </div>
        <!-- END wrapper -->

       <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/detect.js"></script>
        <script src="../assets/js/fastclick.js"></script>
        <script src="../assets/js/jquery.slimscroll.js"></script>
        <script src="../assets/js/jquery.blockUI.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/js/jquery.scrollTo.min.js"></script>


        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>

        
        <script type="text/javascript" src="../assets/plugins/parsleyjs/dist/parsley.min.js"></script>
        
        
        <script type="text/javascript">
      $(document).ready(function() {
        $('form').parsley();
      });
    </script>
   
  
     <script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="../assets/plugins/switchery/dist/switchery.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="../assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="../assets/plugins/select2/select2.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

  </body>
</html>
<?php }?>