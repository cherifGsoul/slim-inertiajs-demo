import React from 'react';
import Link from '../components/Link';
import Header from '../components/Header';
import Heading from '../components/Heading';

export default function Home(props) {
    return (
<div>
    <Header />
    {/* Breadcrumbs */}
    <div class="p-6">Home</div>

    <div class="w-4/6 border bg-white shadow overflow-hidden sm:rounded-lg mx-auto p-6">
        <Heading size="1">{ props.message }</Heading>
    </div>
</div>
    )
};