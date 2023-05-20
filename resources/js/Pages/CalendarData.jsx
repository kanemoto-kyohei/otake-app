import { usePage } from "@inertiajs/react";

export function Data({ children }) {
    const { carender_elements } = usePage().props;

    const datesOfWeek = carender_elements.datesOfWeek;

    return (
        <>
            <h1>{carender_elements.holiday[7]}</h1>
        </>
    );
}
