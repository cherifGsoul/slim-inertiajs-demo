import React from 'react';

export default function Heading(props) {
    switch (props.size) {
        case 1 :
            return (<h1 className="text-2xl">{props.children}</h1>);
        break;
        case 2 :
            return (<h2 className="text-xl">{props.children}</h2>);
        break;
        case 3 :
            return (<h3 className="text-xl">{props.children}</h3>);
        break;
        case 4 :
            return (<h4 className="text-base">{props.children}</h4>);
        break;
        case 5 :
            return (<h5 className="text-sm">{props.children}</h5>);
        break;
        case 6 :
            return (<h6 className="text-xs">{props.children}</h6>);
        break;
        default:
            return (<h1 className="text-2xl">{props.children}</h1>);
        break;
    }
    
};