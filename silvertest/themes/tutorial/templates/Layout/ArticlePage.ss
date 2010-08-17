
 
<% include Menu2 %>
<div id="Content" class="typography">
<% include Breadcrumbs %>
<% if Level(2) %>
    <div class="breadcrumbs">
      $Breadcrumbs
    </div>
  <% end_if %>
 
  <h1>$Title</h1>
  $Content
  <div class="newsDetails">
  Posted on $Date.Nice by $Author
</div>
$PageComments

</div>
