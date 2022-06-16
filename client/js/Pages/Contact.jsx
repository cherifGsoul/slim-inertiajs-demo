import React from 'react';
import Link from '../components/Link';
import Heading from '../components/Heading';

export default function Contact(props) {
    return (<div>
        <Heading size="1">Contact {props.author} if you have any questions</Heading>
        <Link href="/">Home</Link>

        <p>You can mix Inertia with traditional routed pages</p>
        <a class="text-sky-500 hover:underline" href="/non-inertia-view">Non-Inertia View</a>
    </div>)
};

