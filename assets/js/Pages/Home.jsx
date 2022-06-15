import React from 'react';
import { Link } from '@inertiajs/inertia-react';

export default function Home() {
    return (<div>
        <h1>Home</h1>
        <Link href="/contact">Contact</Link>
    </div>)
};