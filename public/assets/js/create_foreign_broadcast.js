$('.ui.create_form_dropdown').dropdown({
    clearable: true,
});

$('#frequency_select').dropdown({
    allowAdditions: true,
    clearable: true,
});

$('.frequency_select_cl').dropdown({
    allowAdditions: true,
    clearable: true,
});

const local_input_collection = {
    emfs_level: ['emfs_level'],
    response_direction: ['response_direction'],
    response_quality: ['response_quality'],
    response_quality_addition: ['response_quality_addition'],
    emfs_level_addition: ['emfs_level_addition'],
    response_direction_addition: ['response_direction_addition'],
}

const addNewBtn = document.getElementById('addRow');

if(addNewBtn){
    addNewBtn.addEventListener('click', function () {
        local_input_collection.emfs_level.push(`emfs_level${rowCount+1}`);
        local_input_collection.response_direction.push(`response_direction${rowCount+1}`);
        local_input_collection.response_quality.push(`response_quality${rowCount+1}`);
        local_input_collection.response_quality_addition.push(`response_quality_addition${rowCount+1}`);
        local_input_collection.emfs_level_addition.push(`emfs_level_addition${rowCount+1}`);
        local_input_collection.response_direction_addition.push(`response_direction_addition${rowCount+1}`);
    })
}

$(document).on('change', '[myUniqueItem^="response_quality_local"]', function(e) {
    handleChangeBlocks(e.target.id)
});

function handleChangeReviews_FOREIGN(review_element){
    const selectedValue = $(`#${review_element}`).find(":selected").val();
    const isReviewChosen = selectedValue !== '';
    const uniqueIndex = review_element.substring(25, review_element.length);

    foreign_input_collection.cons_or_peri.map(cons_or_peri => {
        if(cons_or_peri.substring(12, cons_or_peri.length) === uniqueIndex){
            $(`#${cons_or_peri}`).css('display', isReviewChosen ? 'inline-block' : 'none');
            isReviewChosen ? $(`#${cons_or_peri}`).closest('div').removeClass('constant_periodic_select') : $(`#${cons_or_peri}`).closest('div').addClass('constant_periodic_select');
        }
    });
}
