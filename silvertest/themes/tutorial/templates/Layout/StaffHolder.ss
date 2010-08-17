<% include Menu2 %>
 
<div id="Content" class="typography">
  <% include Breadcrumbs %>
  $Content
 
  <ul id="StaffList">
    <% control Children %>
      <li>
        <div class="staffname"><a href="$Link">$Title</a></div>
        <div class="staffphoto">$Photo.SetWidth(50)</div>
        <div class="staffdescription"><p>$Content.FirstSentence</p></div>
      </li>
    <% end_control %>
  </ul>
</div>