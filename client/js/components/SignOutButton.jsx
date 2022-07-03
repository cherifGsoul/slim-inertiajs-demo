import React from 'react';

const SignOutButton = props => {
    return (
        <>
            {
            props.show && 
            <div class="ml-3 relative">
                <a
                    href="/logout"
                    className="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-500 hover:bg-indigo-600"
                >Sign Out</a>
            </div>
            }
        </>
    );
};

export default SignOutButton;