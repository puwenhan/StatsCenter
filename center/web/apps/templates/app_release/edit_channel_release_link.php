<?php include __DIR__.'/../include/header.php'; ?>

<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="/">首页</a></li>
            <li><a href="/app_release/app_list">APP列表</a></li>
            <li>
                <a href="/app_release/release_link_list?app_id=<?=$app['id']?>&package_type=<?php echo $package_type; ?>">
                    「<?=model('App')->getOSName($app['os'])?> - <?=$app['name']?> <?=$release['version_number']?>」
                    <?php echo \App\PackageType::getPackageTypeName($package_type); ?>列表
                </a></li>
            <li><?=isset($_GET['id']) ? '编辑' : '新增'?>「<?=model('App')->getOSName($app['os'])?> - <?=$app['name']?> <?=$release['version_number']?>」
                <?php echo \App\PackageType::getPackageTypeName($package_type); ?>
            </li>
        </ol>
        </ol>
    </div>

    <div id="content">
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php if (!empty($msg)) : ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> 提示</h4>
                        <p><?=$msg?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="alert-heading"><i class="fa fa-ban"></i> 错误</h4>
                        <p><?=reset($errors)?></p>
                    </div>
                <?php endif ?>
            </div>

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

                <div class="jarviswidget jarviswidget-color-darken jarviswidget-sortable" id="wid-id-0"
                     data-widget-editbutton="false" role="widget" style="width: 600px;float: left">
                    <header role="heading">
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2><?=isset($_GET['id']) ? '编辑' : '新增'?>「<?=model('App')->getOSName($app['os'])?> - <?=$app['name']?> <?=$release['version_number']?>」
                            <?php echo \App\PackageType::getPackageTypeName($package_type); ?>
                        </h2>
                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
                    <div class="widget-body">
                        <form id="form1" class="smart-form" role="form" action="" method="post" enctype="multipart/form-data">
                            <?php if (!isset($_GET['id'])) : ?>
                            <fieldset>
                                <section>
                                    <label class="label">渠道 <b class="text-danger">*</b></label>
                                    <label class="select">
                                        <?=\Swoole\Form::select('app_channel', array_filter_value(array_get($form_data, 'channel_list'), true), filter_value(array_get($form_data, 'app_channel'), true), false, ['class' => 'select2'], false)?>
                                    </label>
                                </section>
                            </fieldset>
                            <?php endif; ?>
                            <fieldset>
                                <?php if ($package_type === \App\PackageType::SHARED_OBJECT) : ?>
                                    <section>
                                        <label class="label">自定义下发数据 <b class="text-danger">*</b></label>
                                        <label class="textarea">
                                            <?=\Swoole\Form::text('custom_data', filter_value(array_get($form_data, 'custom_data')), ['rows' => 10])?>
                                        </label>
                                    </section>
                                <?php else : ?>
                                    <section>
                                        <label class="label">下载地址 <b class="text-danger">*</b></label>
                                        <label class="input">
                                            <?=\Swoole\Form::input('release_link', filter_value(array_get($form_data, 'release_link')))?>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">MD5 <b class="text-danger">*</b></label>
                                        <label class="input">
                                            <?=\Swoole\Form::input('md5', filter_value(array_get($form_data, 'md5')))?>
                                        </label>
                                    </section>
                                <?php endif; ?>
                                <section>
                                    <label class="label">备注</label>
                                    <label class="textarea">
                                        <?=\Swoole\Form::text('remarks', filter_value(array_get($form_data, 'remarks')))?>
                                    </label>
                                </section>
                                <?php if (!$has_fallback_link || !empty($is_fallback_link)) : ?>
                                    <section>
                                        <label class="label">缺省渠道</label>
                                        <label class="checkbox">
                                            <input name="fallback_link" type="checkbox"<?php if (!empty($is_fallback_link) || !empty(array_get($form_data, 'fallback_link'))) : ?> checked="checked"<?php endif; ?>><i></i>
                                            没有配置的渠道，都使用该渠道下发的内容
                                        </label>
                                    </section>
                                <?php else : ?>
                                    <section>
                                        <label class="label">缺省渠道</label>
                                        <label class="checkbox state-disabled">
                                            <input name="fallback_link" type="checkbox" disabled="disabled"><i></i>
                                            没有配置的渠道，都使用该渠道下发的内容
                                        </label>
                                        <div class="note">只能有一个缺省渠道，所以这里无法勾选</div>
                                    </section>
                                <?php endif; ?>
                            </fieldset>
                            <footer>
                                <input name="package_type" type="hidden" value="<?=$package_type?>">
                                <button type="submit" id="sub" class="btn btn-primary">
                                    提交
                                </button>
                                <button type="button" class="btn btn-default" onclick="window.history.go(-1);">
                                    返回
                                </button>
                            </footer>
                        </form>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<?php include dirname(__DIR__).'/include/javascript.php'; ?>
<script>
    $(function() {
        pageSetUp();
    });
</script>

</body>
</html>
