<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FooterColumn;
use App\Models\FooterLink;
use App\Models\FooterSetting;
use App\Models\GeneralSetting;
use App\Models\SeoSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // ─── General Settings ───────────────────────────────────────────

    public function generalShow(): JsonResponse
    {
        return response()->json(['data' => GeneralSetting::instance()]);
    }

    public function generalUpdate(Request $request): JsonResponse
    {
        $settings = GeneralSetting::instance();
        $settings->update($request->all());

        return response()->json([
            'message' => 'General settings update ho gayi!',
            'data'    => $settings->fresh(),
        ]);
    }

    // ─── SEO Settings ───────────────────────────────────────────────

    public function seoIndex(): JsonResponse
    {
        $seo = SeoSetting::all()->keyBy('page');
        return response()->json(['data' => $seo]);
    }

    public function seoShow(string $page): JsonResponse
    {
        $seo = SeoSetting::forPage($page);
        return response()->json(['data' => $seo]);
    }

    public function seoUpdate(Request $request, string $page): JsonResponse
    {
        $seo = SeoSetting::forPage($page);
        $seo->update($request->all());

        return response()->json([
            'message' => "SEO settings ({$page}) update ho gayi!",
            'data'    => $seo->fresh(),
        ]);
    }

    public function seoPages(): JsonResponse
    {
        return response()->json(['data' => SeoSetting::pages()]);
    }

    // ─── Footer Settings ────────────────────────────────────────────

    public function footerShow(): JsonResponse
    {
        $footer  = FooterSetting::instance();
        $columns = FooterColumn::with('links')->where('is_active', true)->orderBy('sort_order')->get();

        return response()->json([
            'data' => [
                'settings' => $footer,
                'columns'  => $columns,
            ],
        ]);
    }

    public function footerUpdate(Request $request): JsonResponse
    {
        $footer = FooterSetting::instance();
        $footer->update($request->all());

        return response()->json([
            'message' => 'Footer settings update ho gayi!',
            'data'    => $footer->fresh(),
        ]);
    }

    // Footer Columns
    public function footerColumns(): JsonResponse
    {
        return response()->json([
            'data' => FooterColumn::with('links')->orderBy('sort_order')->get(),
        ]);
    }

    public function storeFooterColumn(Request $request): JsonResponse
    {
        $request->validate([
            'title'      => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'boolean',
        ]);

        $column = FooterColumn::create($request->all());

        return response()->json([
            'message' => 'Footer column ban gaya!',
            'data'    => $column,
        ], 201);
    }

    public function updateFooterColumn(Request $request, FooterColumn $footerColumn): JsonResponse
    {
        $footerColumn->update($request->all());

        return response()->json([
            'message' => 'Footer column update ho gaya!',
            'data'    => $footerColumn->fresh(),
        ]);
    }

    public function destroyFooterColumn(FooterColumn $footerColumn): JsonResponse
    {
        $footerColumn->links()->delete();
        $footerColumn->delete();

        return response()->json(['message' => 'Footer column delete ho gaya!']);
    }

    // Footer Links
    public function storeFooterLink(Request $request, FooterColumn $footerColumn): JsonResponse
    {
        $request->validate([
            'label'          => 'required|string|max:100',
            'url'            => 'required|string|max:500',
            'open_in_new_tab'=> 'boolean',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ]);

        $link = $footerColumn->links()->create($request->all());

        return response()->json([
            'message' => 'Footer link ban gaya!',
            'data'    => $link,
        ], 201);
    }

    public function destroyFooterLink(FooterLink $footerLink): JsonResponse
    {
        $footerLink->delete();
        return response()->json(['message' => 'Footer link delete ho gaya!']);
    }
}