<br/><br/><br/><br/>

<table class ='table table-condensed'>
  <thead>
    <tr><th>ID</th><th><center>Election</center><th><th>Choice Candidate</th></tr>
  <thead>
  <tbody>
    <?php if (count($elections) >= 1) { ?>
    <form method = 'POST' action="<?php echo base_url('index.php/voter_dashboard/vote'); ?>">
    <?php for($index=0; $index < count($elections); $index++) {?>
      <?php $candidates = get_candidate($elections[$index]['election_id']); ?>
      <?php //var_dump($candidates); ?>
      <tr>
      <td><?php echo $index + 1 ?></td>
      <td><input type = 'text' value = '<?php //echo $elections[$index]['election']; ?>' name = '<?php echo $elections[$index]['election']; ?>'  hidden>
      
      <center><input type = 'text' value = '<?php echo $elections[$index]['election']; ?>' name = '<?php echo $elections[$index]['election']; ?>'  disabled></center>

      <td>
      <td>
        
          <select name='<?php echo $elections[$index]['election']; ?>'>
          <option value='0'>Select Candidate</option>
          <?php for($i=0; $i < count($candidates); $i++){ ?>
          <option value='<?php  echo $candidates[$i]['cand_id']; ?>'><?php  echo $candidates[$i]['cand_name']; ?></option>
          <?php } ?>
        </select>
        
      </td>
      <?php } ?>
    </tr>
    <tr><td></td><td></td><td></td><td><input type='submit' value='Vote' /></td></tr>

    </form>
    <?php } elseif (!count($elections) >= 1){ ?>
      <tr>
        <td></td>
        <td><center>You Have No Pending Election To Vote For. Thanks</center></td>
        <td></td>
      </tr> 
    <?php } ?>
  <tbody> 
</table>