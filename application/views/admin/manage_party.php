
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
            <!-- General Form Elements -->
            <div class="search-bar">
            <?php echo validation_errors(); ?>
              <?php echo form_open($action= base_url('index.php/admin/manage_party'), $attributes=array('method' => 'POST', "class" => "search-form d-flex align-items-center")); ?>
              <?php echo form_input($query); ?>
              <!-- <input type="text" name="query" placeholder="Search" title="Enter search keyword">  -->
              <?php echo form_dropdown('search_type', $search_type, $selected = 'default',$extra=$attr); ?>  

                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>
            </div><!-- End Search Bar -->


            <!-- ?php echo form_open($action="", $attributes=array('method'=>"POST"));?>
            
              <div class="row mb-3">
                  < ?php form_error('query', 'div class="errro">', '</div>'); ?>
                  <input type='text' name='party search' placeholder="enter party name">
                  <select>
                    <option value="party_name">Pary  name</option>
                    <option value="slogan">Slogan</option>
                    <option value="abbrevion">Abbreviation</option>
                  </select>
                    <button type="submit" class="btn btn-primary">Search Party</button>
                <div class="row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit Form</button>
                </div>
              </div>
              </div>
            < ?php //echo form_close(); ?>< !-- End General Form Elements -->
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
              <?php if (empty($table_data)) { ?>
              <?php echo "<tr><td><b>No Data To Display</b><td></tr>"; }else{?>

              <?php for($index = 1; $index <= count($table_data); $index++){ ?>
              <?php 
                echo "<tr>";
                //echo "<th scope='row'>$index</th>";
                echo "<td>" . $table_data->name . "</td>";
                echo "<td>" . $table_data->abbreviation . "</td>";
                echo "<td>" . $table_data->slogan . "</td>";
                echo "<td>" . $table_data->ideology . "</td>";
                echo "<td>" . $table_data->status . "</td>";
                ?>
              <td><a target="_blank" href="<?php echo base_url('index.php/admin/update_party'); ?>">Update</a></td>
              <?php 
                // echo "<td>" . $table_data->slogan . "</td>";
                echo "</tr>";
              ?>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
          </div>
        </div>

      </div>
    </div>
  </section>  
</main><!-- End #main -->
