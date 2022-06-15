import React from 'react';
import { Link } from '@inertiajs/inertia-react';

export default function Home(props) {
    return (<div>
        <h1>{ props.message }</h1>
        <Link href="/contact">Contact</Link>

        <p>You can mix Inertia with traditional routed pages (normal non-react links)</p>
        <a href="/non-inertia-view">Non-Inertia View</a>
    </div>)
};