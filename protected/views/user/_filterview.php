<li>
    <div class="dropdown hideonhover">
        <span class="glyphicon glyphicon-cog dropdown-toggle" style="visibility: hidden;" role="menu" id="dropdownMenu1" 
              data-toggle="dropdown" aria-expanded="true" aria-hidden="true"></span>
        <a data-filter=".<?php echo $data->name; ?>"><?php echo $data->label; ?></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Edit</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Remove from Favorite</a></li>
        </ul>
    </div>
</li>
