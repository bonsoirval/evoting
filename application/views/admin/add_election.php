
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
            <?php print(form_open($action="", $attributes=array('method'=>"POST", 'name' => 'add_election')));?>
              <div class="row mb-3"><?php 
              if($this->session->flashdata('election_added')){
                print($this->session->flashdata('election_added'));
                } ?>
                <?php print(form_label('Election', 'election', $attribute = array('col-sm-2 col-form-label'))); ?>
                <div class="col-sm-10">
                  <?php print(form_error('election', '<div class="error">', '</div>')); ?>
                  <?php print(form_input($election)); ?>
                </div>
              </div>
              <div class="row mb-3">
                <?php print(form_label('Election Region', 'election_region')); ?>
                <div class="col-sm-10">
                  <?php print(form_error('election_region', '<div class="error">', '</div>')); ?>
                  <?php // add form_input($region); ?>
                  <?php print(form_dropdown('region', $options)); ?>
                </div>
              </div>
              <div class="row mb-3">
                <?php print(form_label('Election date', 'election_date')); ?>
                <div class="col-sm-10">
                  <?php print(form_error('election_date', '<div class="error">', '</div>')); ?>
                  <?php print(form_input($election_date)); ?>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-10">
                  <?php print(form_input($add_election)); ?>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>
    </div>
  </section>  
</main><!-- End #main -->
