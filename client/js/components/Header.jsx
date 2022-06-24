import React from 'react';
import Link from '../components/Link';
import { Link as InertiaLink }  from '@inertiajs/inertia-react';

export default function Header()
{
    return (
<div class="mx-auto px-4 sm:px-6 border-b-2 border-gray-100">
    <div class="flex justify-between items-center py-6 md:justify-start md:space-x-10">
        <div class="flex justify-start lg:w-0 lg:flex-1">
        <InertiaLink href="/" className="text-base font-medium text-gray-500 hover:text-gray-900">Noesis Framework v0.1</InertiaLink>
        </div>
        
        <nav class="hidden md:flex space-x-10">
            <InertiaLink href="/" className="text-base font-medium text-gray-500 hover:text-gray-900">Home</InertiaLink>
            <InertiaLink href="/contact" className="text-base font-medium text-gray-500 hover:text-gray-900">Contact</InertiaLink>
            <a class="text-base font-medium text-gray-500 hover:text-gray-900" href="/non-inertia-view">Non-Inertia View</a>
        </nav>
        <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
            <InertiaLink href="/login" className="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"> Sign in </InertiaLink>
            <InertiaLink href="/register" className="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"> Sign up </InertiaLink>
        </div>
    </div>
</div>
    );
}