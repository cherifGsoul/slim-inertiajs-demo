import React from 'react';
import Link from '../components/Link';
import Heading from '../components/Heading';

export default function Home(props) {
    return (<div>
        <Heading size="1">{ props.message }</Heading>
        <Link href="/contact">Contact</Link>

        <p>You can mix Inertia with traditional routed pages (normal non-react links)</p>
        <a class="text-sky-500 hover:underline" href="/non-inertia-view">Non-Inertia View</a>
    </div>)
};