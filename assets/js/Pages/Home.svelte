<script>
import { Link } from '@inertiajs/inertia-svelte'

// Property to be set
// from the server response
export let message;

</script>

<h1>Home Page</h1>

<h2>{message}</h2>

<Link href="/contact">Contact</Link>

<Link href="/invalid">404</Link>

