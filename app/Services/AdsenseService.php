<?php

use App\Models\Advertisement;

function adsense($type)
{
    $adsense = Advertisement::where('type', $type)->where('status', true)->first();
    return $adsense;
}

function adsense_header()
{
    if (adsense('adsense_header')) {
        return adsense('adsense_header')->code;
    }
}

function adsense_download_top_728x90()
{
    if (adsense('adsense-download-top-728x90')) {
        return '<center>
                    <div class="google-ads-728 mb-6">' . adsense('adsense-download-top-728x90')->code . '</div>
                </center>';
    }
}

function adsense_download_bottom_728x90()
{
    if (adsense('adsense-download-bottom-728x90')) {
        return '<center>
                    <div class="google-ads-728 mb-6">' . adsense('adsense-download-bottom-728x90')->code . '</div>
                </center>';
    }
}

function adsense_download_300x250()
{
    if (adsense('adsense-download-300x250')) {
        return '<center>
                    <div class="google-ads-300 mb-6">' . adsense('adsense-download-300x250')->code . '</div>
                </center>';
    }
}

function adsense_frontend_features_728x90()
{
    if (adsense('adsense-frontend-features-728x90')) {
        return '<center>
                    <div class="google-ads-728 mb-6">' . adsense('adsense-frontend-features-728x90')->code . '</div>
                </center>';
    }
}

function adsense_frontend_blogs_728x90()
{
    if (adsense('adsense-frontend-blogs-728x90')) {
        return '<center>
                    <div class="google-ads-300 mt-8">' . adsense('adsense-frontend-blogs-728x90')->code . '</div>
                </center>';
    }
}