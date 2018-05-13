<div class="container-fluid">
  <div class="title col-lg-6 col-sm-10 mx-auto mt-5"><?php echo $title ?></div>
  <!--  主要留言的撰寫框 START  -->
  <div class="cmmt-box col-lg-6 col-sm-10 mx-auto mb-2 p-4">
    <?php if ( isset($_SESSION['user_id']) ): ?>
      <div>
        <div class="cmmt__nickname">
          <?php echo htmlentities($current_nickname) ?>
          <span class="cmmt__logout">[ 登出 ]</span>
        </div>
        <textarea class="cmmt__textarea" name="content" placeholder="留言內容" required></textarea>
        <input type="hidden" name="parent_id" value='0' />
        <input class="cmmt__btn btn btn-primary" type="submit" value="送 出" />
      </div>
    <?php else: ?>
      <input class="cmmt__btn btn btn-primary" type="button" value="登入以使用留言功能" onclick="location.href='<?php echo base_url('/user/login/') ?>'" />
    <?php endif; ?>
  </div> <!--  主要留言的撰寫框END  -->

  <?php foreach ( $cmmts as $c_item ): ?>
    <!--  主留言外框 START  -->
    <div class="cmmt-box col-lg-6 col-sm-10 mx-auto mb-2 p-4">
      <!--  顯示主留言 START  -->
      <div class="cmmt__header">
        <div class="cmmt__nickname"><?php echo htmlentities($c_item['nickname']) ?></div>
        <div>
          <div class="cmmt__time"><?php echo $c_item['created_by'] ?></div>
          <div class="cmmt__edit-delete">
            <?php if ( isset($_SESSION['user_id']) AND $c_item['user_id'] === $_SESSION['user_id'] ): ?>
              <span class="cmmt__edit">編輯</span>&nbsp;/&nbsp;<span class="cmmt__delete">刪除</span>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="cmmt__content"><?php echo htmlentities($c_item["content"]) ?></div>
      <div class="cmmt__id"><?php echo $c_item["cmmt_id"] ?></div>

      <!--  顯示子留言串 START  -->
      <?php foreach ( $c_item['sub_cmmts'] as $s_item ): ?>
        <?php if ( $s_item['user_id'] === $c_item['user_id'] ): ?>
          <div class="sub-cmmt sub-cmmt__main-author col-11">
        <?php else: ?>
          <div class="sub-cmmt col-11">
        <?php endif; ?>
          <div class="cmmt__header">
            <div class="cmmt__nickname"><?php echo htmlentities($s_item["nickname"]) ?></div>
            <div>
              <div class="cmmt__time"><?php echo $s_item["created_by"] ?></div>
              <div class="cmmt__edit-delete">
                <?php if ( isset($_SESSION['user_id']) AND $s_item['user_id'] === $_SESSION['user_id'] ): ?>
                  <span class="cmmt__edit">編輯</span>&nbsp;/&nbsp;<span class="cmmt__delete">刪除</span>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="cmmt__content"><?php echo htmlentities($s_item["content"]) ?></div>
          <div class="cmmt__id"><?php echo $s_item["cmmt_id"] ?></div>
        </div>
      <?php endforeach; ?>

      <!--   子留言的撰寫框 START  -->
      <div class="sub-cmmt">
        <?php if ( isset($_SESSION['user_id']) ): ?>
          <div class="sub-cmmt__collapse-toggle">回應[+]</div>
          <div>
            <div class="cmmt__nickname"><?php echo htmlentities($current_nickname) ?></div>
            <textarea class="cmmt__textarea" name="content" placeholder="留言內容" required></textarea>
            <input type="hidden" name="parent_id" value=<?php echo $c_item['cmmt_id'] ?> />
            <input class="cmmt__btn sub-cmmt__btn btn btn-primary" type="submit" value="送 出" />
          </div>
        <?php else: ?>
          <a class="sub-cmmt__login-link text-primary" onclick="location.href='<?php echo base_url('/user/login/') ?>'">
            登入以發表回應 
          </a>
        <?php endif; ?>
      </div> <!--   子留言的撰寫框 END  -->
    </div> <!-- 主留言外框 END -->
  <?php endforeach; ?>  


  <!-- Bootstrap 分頁 START -->
  <nav aria-label="comment borad pages" class="my-5">
     <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $page === 1 ? 'disabled' : '' ?> ">
        <a class="page-link" href="<?php echo base_url( "/page/". ($page-1) ) ?>" aria-label="Previous" tabindex="-1">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <?php for( $k=1; $k <= $total_pages; $k++ ): ?>
        <li class="page-item <?php if( $k === $page ) echo 'disabled' ?>">
          <a class="page-link" href="<?php echo base_url("/page/$k") ?>"><?php echo $k ?></a>
        </li>
      <?php endfor ?>
      <li class="page-item <?php echo $page === $total_pages ? 'disabled' : '' ?>">
        <a class="page-link" href="<?php echo base_url( "/page/". ($page+1) ) ?>" aria-label="Next" tabindex="-1">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </nav><!-- Bootstrap 分頁 END -->
</div> <!-- END of container-fluid -->


