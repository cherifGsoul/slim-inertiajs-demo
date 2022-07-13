import React, {useState} from 'react';

const SignInButton = props => {
    let [showMenu, setShowMenu] = useState(false);

    const LoginMenu = ({show}) => {
        return (
            <>
                {
                    show && 
                    <div className="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                        <a href="/login/github" className="block px-4 py-2 text-sm text-gray-700" role="menuitem" id="user-menu-item-0">Github</a>
                        <a href="/login/linkedin" className="block px-4 py-2 text-sm text-gray-700" role="menuitem" id="user-menu-item-0">LinkedIn</a>
                        <a href="/login/twitter" className="block px-4 py-2 text-sm text-gray-700" role="menuitem" id="user-menu-item-0">Twitter</a>
                    </div>
                }
            </>
        );
    };
    return (
        <>
            {
            props.show && 
            <div className="ml-3 relative">
                <button
                    onClick = {(e) => {
                        e.preventDefault();

                        setShowMenu(!showMenu);
                    }}
                    type="button"
                    className="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-700 hover:bg-indigo-800"
                >Sign in</button>
                <LoginMenu show={showMenu} />
            </div>
            }
        </>
    );
};

export default SignInButton;