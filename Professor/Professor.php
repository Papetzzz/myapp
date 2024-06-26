
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register-CpE Communication System-</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- My Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<?php
    $errors = array('defaultPass' =>'');
    $DefaultPassword = "CPEPROF2024";

    if (isset($_POST['Password'])){
      if ($_POST['Password'] !== $DefaultPassword){
          $errors['defaultPass']="Password invalid";
      } else {
?>
        <script>
          $(function(){
            $('#divProfessorVerify').hide();
            $('#divProfessorCreate').show('fast');
          })

        </script>
  <?php
      }
    }
  ?>
<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="../assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block text-center">CpE Communication System</span>

                </a>
              </div><!-- End Logo -->

              <div class="card mb-3" id="divProfessorCreate" style="display: none;">

                <div class="card-body">

                  <div class="pt-4 pb-2 text-center">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small mb-0">Enter your personal details to create account</p>
                    <span class="badge rounded-pill bg-light text-primary">PROFESSOR</span>
                  </div>

                  <form class="row g-3 needs-validation" action="Connection.php"method="post" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Full Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" placeholder="Juan A. Dela Cruz" required >
                      <div class="invalid-feedback">Please, enter your full name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">ID Number</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                        <input type="text" name="id_number" class="form-control" id="yourEmail" placeholder="24-00000" required>
                        <div class="invalid-feedback">Please enter a valid ID Number!</div>
                        <script>
                          $('#yourEmail').focusout(function(){
                            checkIdNumber($(this).val());
                          })
                          function checkIdNumber(IdNum){
                            $.ajax({
                                url: '../fetch_Id.php',
                                type: 'GET',
                                data: { IdNum: IdNum },
                                dataType: 'json',
                                success: function(response) {
                                      if (response.exists == 1){
                                        $('#btnProfessorCreate').prop('disabled',true)
                                        $('#divIDAlert').text(IdNum + ' is already registered in the system');
                                      } else if (response.exists ==0) {
                                        $('#btnProfessorCreate').prop('disabled',false)
                                        $('#divIDAlert').text('');
                                      }
                                },
                                error: function(xhr, status, error) {
                                    // Error
                                    console.error(error.message);
                                    console.error(xhr.responseText);
                                    console.error('Failed to fetch sections');
                                }
                            });

                          }
                        </script>
                      </div>
                      <div class="small text-primary" id="divIDAlert"></div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Password</label>
                      <div class="has-validation">
                        <input type="password" name="Password" class="form-control" id="yourUsername" placeholder="Password" minlength="6" minlength="6" required>
                        <div class="invalid-feedback text-wrap">Please create a stronger password.
                          <span class="badge border-danger border-1 text-danger">(Atleast 6 characters that is a combination of lower and upper cases, numbers, and symbols)</span>
                        </div>
                      </div>
                    </div>
 

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" id="btnProfessorCreate">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="../LoginPage.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="card mb-3" id="divProfessorVerify">

                <div class="card-body">

                  <div class="pt-4 pb-2 text-center">
                    <h5 class="card-title text-center pb-0 fs-4">Verify Professor</h5>
                    <p class="text-center small mb-0">Enter professor's password for verification.</p>
                    <span class="badge rounded-pill bg-light text-primary">PROFESSOR</span>
                  </div>

                  <form class="row g-3 needs-validation" action="Professor.php"method="post" novalidate>                    
                    <div class="small text-primary" id="divIDAlert"></div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Password</label>
                      <div class="has-validation">
                        <input type="password" name="Password" class="form-control" id="yourUsername" placeholder="Password" required>
                        <div class="invalid-feedback text-wrap">Please enter password.</div>
                        <span class="invalid-feedback text-wrap" style="display:block"><?php echo $errors['defaultPass'];?></span>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="submit" value="submit" id="btnProfessorCreate">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="../LoginPage.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>