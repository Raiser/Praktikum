<% if Menu(2) %>
  <ul id="Menu2">
    <% control Menu(2) %>
      <li class="$LinkingMode"><a href="$Link" title="Go to the $Title page">$MenuTitle</a></li>
    <% end_control %>
  </ul>
<% end_if %>