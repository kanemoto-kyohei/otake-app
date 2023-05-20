import { usePage, Head, Link, useForm } from "@inertiajs/react";
import { Inertia } from "@inertiajs/inertia";

const CancelButton = (props) => {
    const { date, time, id } = props;
    return (
        <Link
            style={{ color: "red", textDecoration: "underline" }}
            href={route("appoint.inertiaDeleteconf")}
            method="post"
            data={{
                selected_date_time: `${date}|${time}|${id}`,
            }}
            as="button"
            type="button"
            preserveState={false}
            onIonClick={(e) => {
                e.preventDefault();
                Inertia.post(route("appoint.inertiaDeleteconf"), {
                    selected_date_time: `${date}|${time}`,
                });
            }}
        >
            キャンセルする
        </Link>
    );
};
export default CancelButton;
