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
            <h5 class="card-title">Manage Party</h5>
            <table class="table">
            <thead>
              <tr>
                <th scope="col">Party</th>
                <th scope="col">Abbreviation</th>
                <th scope="col">Slogan</th>
                <th scope="col">Ideology</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($party_update)) { ?>
              <?php echo "<tr><td><b>No Data To Display</b><td></tr>"; }else{?>
              <?php 
                if($this->session->flashdata('party_update') != ''){
                  print($this->session->flashdata('message_name'));
                }
              ?>
              <?php print(form_open()); ?>
              <?php print(validation_errors('<span class="error">', '</span>')); ?>
              <?php for($index = 1; $index <= count($party_update); $index++){ ?>
              <td><input type="hidden" name="party_clicked" value="clicked" />
              <?php print(form_input($party)); ?></td>
              <td><?php print(form_input($abbreviation)); ?></td>
              <td><?php print(form_input($slogan)); ?></td>
              <td><?php print(form_input($ideology)); ?></td> 
              <td><?php print(form_dropdown($status, $options, $extra)); ?>
              </td>
              <td><?php print(form_submit($submit = array('name' => 'party_update','class' => 'form-control primary', 'value'=>"Update"))); ?></td>
              <?php echo "</tr>"; ?>
              <?php print(form_close()); }} ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </section>  
</main><!-- End #main -->