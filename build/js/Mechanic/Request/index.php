<!DOCTYPE html>
<?php
  $title = "Request";
  $MechanicHome = "";
  $MechanicRequest = "active";
  $MechanicReport = "";
  

  session_start();
  if (!isset($_SESSION['firstname'])) {
    header("Location:../../../index.php");
  }
  if ($_SESSION['acct_type']!="Mechanic") {
    header("Location:../../../index.php");
  }
  include_once "../../../pages/layout/Mechanic/MechanicNavs.php";
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                      <div class="bs-callout bs-callout-warning" id="callout-glyphicons-accessibility">
                        <h4>Accessible icons</h4>
                        <p>Modern versions of assistive technologies will announce CSS generated content, as well as specific Unicode characters. To avoid unintended and confusing output in screen readers (particularly when icons are used purely for decoration),
                          we hide them with the <code>aria-hidden="true"</code> attribute.</p>
                        <p>If you're using an icon to convey meaning (rather than only as a decorative element), ensure that this meaning is also conveyed to assistive technologies – for instance, include additional content, visually hidden with the <code>.sr-only</code>                        class.</p>
                        <p>If you're creating controls with no other text (such as a <code>&lt;button&gt;</code> that only contains an icon), you should always provide alternative content to identify the purpose of the control, so that it will make sense to
                          users of assistive technologies. In this case, you could add an <code>aria-label</code> attribute on the control itself.</p>
                      </div>


              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                      <div class="bs-callout bs-callout-warning" id="callout-glyphicons-accessibility">
                        <h4>Accessible icons</h4>
                        <p>Modern versions of assistive technologies will announce CSS generated content, as well as specific Unicode characters. To avoid unintended and confusing output in screen readers (particularly when icons are used purely for decoration),
                          we hide them with the <code>aria-hidden="true"</code> attribute.</p>
                        <p>If you're using an icon to convey meaning (rather than only as a decorative element), ensure that this meaning is also conveyed to assistive technologies – for instance, include additional content, visually hidden with the <code>.sr-only</code>                        class.</p>
                        <p>If you're creating controls with no other text (such as a <code>&lt;button&gt;</code> that only contains an icon), you should always provide alternative content to identify the purpose of the control, so that it will make sense to
                          users of assistive technologies. In this case, you could add an <code>aria-label</code> attribute on the control itself.</p>
                      </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <!-- /page content -->
<?php
  include_once "../../../pages/layout/Mechanic/MechanicFoot.php";
?>