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
            <h5 class="card-title">Manage Election</h5>
            <!-- General Form Elements -->
            <div class="search-bar">
            <?php print(validation_errors()); ?>
              <?php print(form_open($action = "admin/update_election", $attributes=array('method' => 'POST', "class" => "search-form d-flex align-items-center"))); ?>
              <?php print form_input($query); ?>
              <?php print(form_input($hidden)); ?>
              <?php print(form_dropdown('search_type', $search_type, $selected = 'default',$extra=$attr)); ?>  
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              <?php print(form_close()); ?>
            </div><!-- End Search Bar -->
            <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Election Title</th>
                <th scope="col">Region</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($result)) { ?>
              <?php print("<tr><td><b>No Data To Display</b><td></tr>"); }else{?>
              <?php 
                if($this->session->flashdata('election_update') != ''){
                  print($this->session->flashdata('message_name'));
                }
              ?>
              <?php print(form_open()); ?>
              <?php print(validation_errors('<span class="error">', '</span>')); ?>
              <?php for($index = 0; $index <= count($result) - 1; $index++){ ?>
              <td>
                <?php print(form_hidden($hidden)); ?>
                <?php //print(form_hidden($hidden)); ?>
                <?php //var_dump($result) //print(form_hidden($hidden)); ?>

              <?php print($index + 1); ?></td>
              <td><?php print(form_input($data = array('name' => 'election_name', 'value' => $result[$index]['name']))); ?></td>
              <td><?php print(form_input($data = array('name' => 'election_region', 'value' => $result[$index]['state']))); ?></td>
              <td><?php print(form_input($data = array('name' => 'election_date', 'value' => $result[$index]['election_date']))); ?></td> 
              <td><?php print(form_dropdown($status = array('name' => "status"), $options = array('' => 'Select Value', '0' => 'Upcoming', '1' => 'Ongoing', '2' => 'Suspended', '3' => 'Completed'), $attr)); ?>
              </td>
              <td><?php print(form_submit($submit = array('name' => 'election_update','class' => 'form-control primary', 'value'=>"Update"))); ?></td>
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