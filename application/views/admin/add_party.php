
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Party Form</h5>

              <!-- General Form Elements -->
              <?php echo form_open($action="", $attributes=array('method'=>"POST"));?>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <?php echo form_error('party', '<div class="error">', '</div>'); ?>
                    <?php echo form_input($name); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Abbreviation</label>
                  <div class="col-sm-10">
                    <?php echo form_error('abbreviation', '<div class="error">', '</div>'); ?>
                    <?php echo form_input($abbreviation); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Slogan</label>
                  <div class="col-sm-10">
                    <?php echo form_error('slogan', '<div class="error">', '</div>'); ?>
                    <?php echo form_input($slogan); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Ideology</label>
                  <div class="col-sm-10">
                    <?php echo form_error('ideologoy', 'div class="errro">', '</div>'); ?>
                    <?php echo form_textarea($ideology); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <?php echo form_button($register); ?>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>  
  </main><!-- End #main -->
