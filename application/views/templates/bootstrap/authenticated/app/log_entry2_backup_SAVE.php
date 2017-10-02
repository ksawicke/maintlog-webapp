<form class="demo-form">
  <div class="form-section">
    <label for="firstname">First Name:</label>
    <input type="text" class="form-control" name="firstname" required="">

    <label for="lastname">Last Name:</label>
    <input type="text" class="form-control" name="lastname" required="">
  </div>
    
  <div class="form-section">
    <label for="firstname1">First Name1:</label>
    <input type="text" class="form-control" name="firstname1" required="">

    <label for="lastname1">Last Name1:</label>
    <input type="text" class="form-control" name="lastname1" required="">
  </div>
    
  <div class="form-section">
    <label for="firstname2">First Name2:</label>
    <input type="text" class="form-control" name="firstname2" required="">

    <label for="lastname2">Last Name2:</label>
    <input type="text" class="form-control" name="lastname2" required="">
  </div>

  <div class="form-section">
    <label for="subflow">Choice:</label>
    <select name="subflow" id="subflow">
        <option value="">Please select one:</option>
        <option value="one">subflow 1</option>
        <option value="two">subflow 2</option>
    </select>
  </div>
    
  <div class="form-section subflow one">
    <label for="email">subflow 1 >> Email:</label>
    <input type="email" class="form-control" name="email" required="">
  </div>

  <div class="form-section subflow one">
    <label for="color">PATH 1 >> Favorite color:</label>
    <input type="text" class="form-control" name="color" required="">
  </div>
    
    <div class="form-section subflow two">
    <label for="email">PATH 2 >> Email:</label>
    <input type="email" class="form-control" name="email" required="">
  </div>

  <div class="form-section subflow two">
    <label for="color">PATH 2 >> Favorite color:</label>
    <input type="text" class="form-control" name="color" required="">
  </div>
    <div class="form-section subflow two">
    <label for="email">PATH 2 >> Email:</label>
    <input type="email" class="form-control" name="email" required="">
  </div>

  <div class="form-section subflow two">
    <label for="color">PATH 2 >> Favorite color:</label>
    <input type="text" class="form-control" name="color" required="">
  </div>

  <div class="form-navigation">
    <button type="button" class="previous btn btn-info pull-left">&lt; Previous</button>
    <button type="button" class="next btn btn-info pull-right">Next &gt;</button>
    <input type="submit" class="btn btn-default pull-right">
    <span class="clearfix"></span>
  </div>

</form>

<style class="example">
.form-section {
padding-left: 15px;
border-left: 2px solid #FF851B;
display: none;
}
.form-section.current {
display: inherit;
}
.btn-info, .btn-default {
margin-top: 10px;
}
</style>

<script type="text/javascript">
$(function () {
  var $sections = $('.form-section'),
     subflowSelected = false,
     currentSubflow = '';

  function navigateTo(index) {
    // Mark the current section with the class 'current'
    $sections
      .removeClass('current')
      .eq(index)
        .addClass('current');
    // Show only the navigation buttons that make sense for the current section:
    $('.form-navigation .previous').toggle(index > 0);
    var atTheEnd = index >= $sections.length - 1;
    $('.form-navigation .next').toggle(!atTheEnd);
    $('.form-navigation [type=submit]').toggle(atTheEnd);
  }

  function curIndex() {
    // Return the current index by looking at which section has the class 'current'
    return $sections.index($sections.filter('.current'));
  }

  $('#subflow').on('change', function() {
      subflowSelected = true,
      currentSubflow = $(this).val();
      
//      console.log("curIndex: " + curIndex());
//      console.log("currentSubflow: " + currentSubflow);
//      console.log("subflowSelected: " + subflowSelected);
      
//      $("." + currentSubflow + ":first");
      var sectionIndex = $("." + currentSubflow + ":first").data("section-index");
//      console.log('test: ' + sectionIndex);
      //Now we can navigate to proper index
      navigateTo(sectionIndex);
//      console.log($("." + currentSubflow + ":first"));
//      navigateTo(7);
      
//      $sections.each(function(index, section) {
//         if(index == curIndex()+1 ) {
//           $(section).find(':input').attr('data-parsley-group', 'block');
//         }
//      });
      
//      $sections.each(function(index, section) {
//         $(section).find(':input').attr('data-parsley-group', 'block-' + (curIndex() + index));
//      });
      
//      $sections.each(function(index, section) {
//         $(section).find(':input').attr('data-parsley-group', 'block-' + index);
//      });
  });

  // Previous button is easy, just go back
  $('.form-navigation .previous').click(function() {
    navigateTo(curIndex() - 1);
  });

  // Next button goes forward if current block validates
  $('.form-navigation .next').click(function() {
    $('.demo-form').parsley().whenValidate({
      group: 'block-' + curIndex()
    }).done(function() {
      navigateTo(curIndex() + 1);
    });
  });

  // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
  $sections.each(function(index, section) {
      $(section).find(':input').attr('data-parsley-group', 'block-' + index);
      $(section).attr("data-section-index", index);
  });
  navigateTo(0); // Start at the beginning
});
</script>