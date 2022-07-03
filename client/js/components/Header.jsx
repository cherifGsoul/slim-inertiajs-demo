import React from 'react';
import { Link as InertiaLink }  from '@inertiajs/inertia-react';
import SignInButton from './SignInButton';
import SignOutButton from './SignOutButton';

export default function Header(props)
{
    let isUserLoggedIn = props.user?.login ?? false;

    return (
<div className="mx-auto px-4 sm:px-6 border-b-2 border-gray-100">
    <div className="flex justify-between items-center py-6 md:justify-start md:space-x-10">
        <div className="flex justify-start lg:w-0 lg:flex-1">
        <InertiaLink href="/" className="text-base font-medium text-gray-500 hover:text-gray-900">Noesis Framework</InertiaLink>
        </div>
        
        <nav className="hidden md:flex space-x-10">
            <InertiaLink href="/" className="text-base font-medium text-gray-500 hover:text-gray-900">Home</InertiaLink>
            <InertiaLink href="/contact" className="text-base font-medium text-gray-500 hover:text-gray-900">Contact</InertiaLink>
            <a className="text-base font-medium text-gray-500 hover:text-gray-900" href="/non-inertia-view">Non-Inertia View</a>
        </nav>
        <div className="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
            <SignInButton show={!isUserLoggedIn} />
            <SignOutButton show={isUserLoggedIn} />
        </div>
    </div>
</div>
    );
}
