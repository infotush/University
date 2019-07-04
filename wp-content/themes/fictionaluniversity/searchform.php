<form action="<?php echo esc_url(site_url('/')); ?>" method='get' class='search-form'>
    <label for="s" class='headline headline--medium'>Perform A New Search</label>
        <div class="search-form-row">
        <input type="search" name='s' class="s" id='s' placeholder="what are you looking for?">
        <input type="submit" value='search' class="search-submit">
        </div>
    </form>