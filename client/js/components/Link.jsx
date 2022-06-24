import React from 'react';
import { Link as InertiaLink }  from '@inertiajs/inertia-react';

export default function Link(props) {
    return (<InertiaLink className="text-sky-500 hover:underline" href={props.href}>{props.children}</InertiaLink>);
};