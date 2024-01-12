
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
              <?php print(form_open($action = "admin/manage_election", $attributes=array('method' => 'POST', "class" => "search-form d-flex align-items-center"))); ?>
              <?php print form_input($query); ?>
              <?php // print(form_input($hidden)); ?>
              <?php print(form_dropdown('search_type', $search_type, $selected = 'default',$extra=$attr)); ?>  
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              <?php print(form_close()); ?>
            </div><!-- End Search Bar -->
            <table class="table">
            <thead>
              <tr>
                <th scope="col">Election</th>
                <th scope="col">Region</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($result)) { ?>
              <?php print("<tr><td><b>No Data To Display</b><td><td></td><td></td><td></td></tr>");?>
              <?php  }else{?>
              <?php for($index = 0; $index <= count($result) - 1; $index++){ ?>
              <?php print("<tr>"); ?>
              <?php //var_dump($result);
              /**
               * ["id"]=> string(1) "2" ["state"]=> string(3) "imo" ["name"]=> string(9) "imo guber" ["election_date"]=> string(19) "2024-01-04 00:00:00" ["status"]=> string(8) "upcoming" }
               */
              ?>
              <td><?php print($result[$index]['name']); ?></td>
              <td><?php print(ucfirst($result[$index]['state'])); ?></td>
              <td><?php print(substr($result[$index]['election_date'], -11)); ?></td>
              <td><?php print($result[$index]['status']); ?></td>
              <?php //print("<td>election action</td>"); ?>
              <td><a target="_blank" href="<?php print(base_url('index.php/admin/update_election/'.$result[$index]['id'])); ?>">Update</a></td>
              <?php 
                // echo "<td>" . $table_data->slogan . "</td>";
                print("</tr>");
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
