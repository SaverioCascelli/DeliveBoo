function truncateText(text, textMaxLength) {
    if(text.length < textMaxLength) return text
    return text.substring(0, textMaxLength) + '...';
}

export {truncateText}
