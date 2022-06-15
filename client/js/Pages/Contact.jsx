import React from 'react';
import { Link } from '@inertiajs/inertia-react';

export default function Contact(props) {
    return (<div>
        <h1>Contact {props.author} if you have any questions</h1>
        <Link href="/">Home</Link>

        <p>You can mix Inertia with traditional routed pages</p>
        <a href="/non-inertia-view">Non-Inertia View</a>
    </div>)
};

