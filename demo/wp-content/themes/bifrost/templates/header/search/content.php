<?php 
/**
 * Search Content
 */
?>
<div class="m-site-search__content">
    <div class="m-site-search__close-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </div>
    <div class="container">
        <div class="m-site-search__content__inner">
            <div class="m-site-search__form">
                <form action="<?php echo esc_url(home_url('/')) ?>" method="get">
                    <input class="m-site-search__form__input" placeholder="<?php echo esc_attr__('Search...', 'bifrost') ?>" type="search" name="s" id="search" />
                    <label class="m-site-search__form__icon">
                        <input type="submit" />
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                    </label>
                </form>
            </div>
        </div>
    </div>
</div>