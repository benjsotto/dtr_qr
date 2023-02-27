
        <li><a href="<?php echo site_url($page->my_page_parent ? $page->parent_class_name : $page->my_class_name); ?>">
                <h2 style="margin: 0 0 0 !important;">
                    <i class="<?php echo $page->my_page_parent ? $page->parent_menu_icon : $page->my_menu_icon; ?>"></i> 
                    <?php echo $page->my_page_parent ? $page->parent_page_name : $page->my_page_name; ?>
                </h2>
            </a>
                                        <?php 
//                                        echo '<br>segment1 - '.$this->uri->segment(1);
//                                        echo '<br>segment2 - '.$this->uri->segment(2);
//                                        echo '<br>segment3 - '.$this->uri->segment(3);
//                                        echo '<br>parent_class_name - '.$page->parent_class_name;
//                                        echo '<br>my_class_name - '.$page->my_class_name;
//                                        echo '<br>parent_page_name - '.$page->parent_page_name;
//                                        echo '<br>my_page_name - '.$page->my_page_name;
                                        ?>
        </li>

        <?php if($page->my_page_parent!=0 && $page->my_class_name==$page->parent_class_name){
            if($this->uri->segment(2)==''){ ?>
                <li class="active"><?php echo $page->my_page_name; ?></li>

            <?php } else { ?>
                <li ><a href="<?php echo site_url($page->parent_class_name.'/'.$page->my_class_name); ?>"><?php echo $page->my_page_name; ?></a></li>
        <?php }
        } else if($page->my_page_parent==0 && $page->my_class_name==$this->uri->segment(1)){ 
            
        } else {
            if($this->uri->segment(2)==''){ ?>

            <?php }  else if($this->uri->segment(3)==''){ ?>
                <li class="active"><?php echo $page->my_page_name; ?></li>
            <?php } else if($this->uri->segment(3)!=''){ ?>
                <li ><a href="<?php echo site_url($page->parent_class_name.'/'.$page->my_class_name); ?>"><?php echo $page->my_page_name; ?></a></li>
            <?php } else { ?>
                <li><a href="<?php echo site_url($page->parent_class_name.'/'.$page->my_class_name); ?>"><?php echo $page->my_page_name; ?></a></li>
            <?php }
        } ?>

                                    
                                    
                                    