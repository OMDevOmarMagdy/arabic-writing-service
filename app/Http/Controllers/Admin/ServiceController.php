<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of all services.
     */
    public function index(): View
    {
        $services = Service::latest()->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'pricing_type' => 'required|in:per_page,per_hour,per_min,fixed',
        ], [
            'name.required' => 'اسم الخدمة مطلوب.',
            'name.max' => 'اسم الخدمة يجب ألا يتجاوز 255 حرفاً.',
            'description.max' => 'الوصف يجب ألا يتجاوز 1000 حرف.',
            'icon.max' => 'اسم الأيقونة يجب ألا يتجاوز 100 حرف.',
            'price.numeric' => 'السعر يجب أن يكون رقماً.',
            'price.min' => 'السعر يجب أن يكون 0 أو أكثر.',
            'pricing_type.required' => 'نوع التسعير مطلوب.',
            'pricing_type.in' => 'نوع التسعير غير صالح.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Service::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter++;
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'تمت إضافة الخدمة بنجاح.');
    }

    /**
     * Show the form for editing a service.
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update a service.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'pricing_type' => 'required|in:per_page,per_hour,per_min,fixed',
        ], [
            'name.required' => 'اسم الخدمة مطلوب.',
            'name.max' => 'اسم الخدمة يجب ألا يتجاوز 255 حرفاً.',
            'description.max' => 'الوصف يجب ألا يتجاوز 1000 حرف.',
            'icon.max' => 'اسم الأيقونة يجب ألا يتجاوز 100 حرف.',
            'price.numeric' => 'السعر يجب أن يكون رقماً.',
            'price.min' => 'السعر يجب أن يكون 0 أو أكثر.',
            'pricing_type.required' => 'نوع التسعير مطلوب.',
            'pricing_type.in' => 'نوع التسعير غير صالح.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        // Ensure unique slug (excluding current service)
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Service::where('slug', $validated['slug'])->where('id', '!=', $service->id)->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter++;
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'تم تحديث الخدمة بنجاح.');
    }

    /**
     * Toggle the active status of a service.
     */
    public function toggleStatus(Service $service): RedirectResponse
    {
        $service->update(['is_active' => ! $service->is_active]);

        $status = $service->is_active ? 'تفعيل' : 'تعطيل';

        return redirect()->route('admin.services.index')
            ->with('success', "تم {$status} الخدمة «{$service->name}» بنجاح.");
    }

    /**
     * Delete a service.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $serviceName = $service->name;
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', "تم حذف الخدمة «{$serviceName}» بنجاح.");
    }
}
